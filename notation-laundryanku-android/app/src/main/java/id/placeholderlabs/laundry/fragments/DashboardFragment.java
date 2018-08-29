package id.placeholderlabs.laundry.fragments;


import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toolbar;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.io.IOException;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.Currency;
import java.util.List;
import java.util.Locale;

import id.placeholderlabs.laundry.DashboardActivity;
import id.placeholderlabs.laundry.R;
import id.placeholderlabs.laundry.UploadBukti;
import id.placeholderlabs.laundry.adapters.TransactionsAdapter;
import id.placeholderlabs.laundry.models.TransactionItem;
import id.placeholderlabs.laundry.models.Transactions;
import id.placeholderlabs.laundry.util.CurrencyFormat;
import id.placeholderlabs.laundry.util.SharedPreferenceManager;
import id.placeholderlabs.laundry.util.api.ApiService;
import id.placeholderlabs.laundry.util.api.UtilsApi;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.content.ContentValues.TAG;

/**
 * A simple {@link Fragment} subclass.
 */
public class DashboardFragment extends Fragment {

    TransactionsAdapter transactionsAdapter;
    List<TransactionItem> transactionItems = new ArrayList<>();
    RecyclerView rvTransaction;
    protected RecyclerView.LayoutManager mLayoutManager;
    private TextView saldoTV;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        final View view = inflater.inflate(R.layout.fragment_dashboard, container, false);
        ((DashboardActivity) getActivity()).setToolbarTitle("Dashboard");

        final SharedPreferenceManager sharedPreferenceManager = new SharedPreferenceManager(getContext());

        TextView username = view.findViewById(R.id.username_greet);
        saldoTV = view.findViewById(R.id.user_saldo);
        Button buttonAddSaldo = view.findViewById(R.id.btn_add_saldo);

        username.setText(sharedPreferenceManager.getAppUsername());
//        saldo.setText(CurrencyFormat.rupiah(sharedPreferenceManager.getAppSaldo()));

        rvTransaction = view.findViewById(R.id.transaction_list);
        mLayoutManager = new LinearLayoutManager(getActivity());

        rvTransaction.setLayoutManager(mLayoutManager);

        getSaldo();
        getTransactions();

        buttonAddSaldo.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getContext(), UploadBukti.class);

                // value 1 untuk type transaksi transfer
                intent.putExtra("TYPE", "1");
                intent.putExtra("TRANSACTION_ID", "0");
                startActivity(intent);
            }
        });

        return view;
    }

    public DashboardFragment() {
        // Required empty public constructor
    }

    public void getTransactions()
    {
        ApiService apiService = UtilsApi.getAPIService();
        final SharedPreferenceManager sharedPreferenceManager = new SharedPreferenceManager(getContext());
        apiService.userTransactions("Bearer " + sharedPreferenceManager.getAppAccessToken()).enqueue(new Callback<Transactions>() {
            @Override
            public void onResponse(Call<Transactions> call, Response<Transactions> response) {
                if (response.isSuccessful()) {
                    rvTransaction.setAdapter(new TransactionsAdapter(getContext(), response.body().getData()));
                } else {
                    Log.d(TAG, "onResponse: " + response.errorBody());
                }
            }

            @Override
            public void onFailure(Call<Transactions> call, Throwable t) {
                Log.d(TAG, "onFailure: " + t.getMessage());
            }
        });

    }

    public void getSaldo()
    {
        ApiService apiService = UtilsApi.getAPIService();
        final SharedPreferenceManager sharedPreferenceManager = new SharedPreferenceManager(getContext());
        apiService.getSaldo("Bearer " + sharedPreferenceManager.getAppAccessToken())
                .enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        try {
                            JSONObject data = new JSONObject(response.body().string());
                            saldoTV.setText(CurrencyFormat.rupiah(Float.valueOf(data.getJSONObject("data").getString("saldo"))));

                        } catch (JSONException e) {
                            e.printStackTrace();
                        } catch (IOException e) {
                            e.printStackTrace();
                        }}

                    @Override
                    public void onFailure(Call<ResponseBody> call, Throwable t) {

                    }
                });
    }

}
