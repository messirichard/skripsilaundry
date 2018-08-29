package id.placeholderlabs.laundry.adapters;

import android.content.Context;
import android.content.Intent;
import android.graphics.Movie;
import android.net.Uri;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.List;

import gun0912.tedbottompicker.TedBottomPicker;
import id.placeholderlabs.laundry.R;
import id.placeholderlabs.laundry.UploadBukti;
import id.placeholderlabs.laundry.models.TransactionItem;

/**
 * Created by alfredo on 4/8/2018.
 */


public class TransactionsAdapter extends RecyclerView.Adapter<TransactionsAdapter.MyViewHolder> {
    private List<TransactionItem> transactionItemList;

    private static final int PROSES = 0;
    private static final int SELESAI = 1;

    private Context mContext;

    public TransactionsAdapter(Context context, List<TransactionItem> transactionItemList) {
        this.transactionItemList = transactionItemList;
        this.mContext = context;
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView title, status, pembayaran, tipePembayaran;
        public ImageView icon_status;

        public MyViewHolder(View view) {
            super(view);
            title = (TextView) view.findViewById(R.id.transactions_title);
            status = (TextView) view.findViewById(R.id.laundry_status);
            pembayaran = (TextView) view.findViewById(R.id.payment_status);
            tipePembayaran = view.findViewById(R.id.payment_type);
            icon_status = view.findViewById(R.id.icon_status);
        }
    }
    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.transaction_list_row, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(MyViewHolder holder, int position) {
        final TransactionItem item = transactionItemList.get(position);
        holder.title.setText(item.getName() + " " + item.getWeightTotal() + "kg");

        String paymentType = "";
        switch (item.getPaymentType()) {
            case "1":
                paymentType = "Tunai";
                break;
            case "2":
                paymentType = "Saldo";
                break;
            case "3":
                paymentType = "Transfer";
                break;
        }

        holder.tipePembayaran.setText("Metode Pembayaran: " + paymentType);
        holder.pembayaran.setText( "Status Pembayaran: " + item.getStatusPembayaran());
        holder.status.setText("Status Cucian: " + ((item.getStatusLaundry().equals("1")) ? "Selesai" : "Proses"));

        if (!item.getPaymentType().equals("3")) {
            holder.icon_status.setVisibility(View.GONE);
        } else if (item.getPaymentType().equals("3") && (item.getStatusPembayaran().equals("1"))) {
            holder.icon_status.setVisibility(View.GONE);
        }

        holder.icon_status.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(mContext, UploadBukti.class);
                // value 2 untuk type transaksi transfer
                intent.putExtra("TYPE", "2");
                intent.putExtra("TRANSACTION_ID", item.getTransactionId().toString());
                mContext.startActivity(intent);
            }
        });

    }

    @Override
    public int getItemCount() {
        return transactionItemList.size();
    }
}
