package id.placeholderlabs.laundry;

import android.content.Context;
import android.content.Intent;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.google.firebase.iid.FirebaseInstanceId;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

import id.placeholderlabs.laundry.util.SharedPreferenceManager;
import id.placeholderlabs.laundry.util.api.ApiService;
import id.placeholderlabs.laundry.util.api.UtilsApi;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity {

    ApiService apiApiService;
    EditText usernameEditText;
    EditText passwordEditText;
    Button loginButton;
    Context context;
    SharedPreferenceManager sharedPreferenceManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        context = this;
        sharedPreferenceManager = new SharedPreferenceManager(this);

        apiApiService = UtilsApi.getAPIService();
        usernameEditText = findViewById(R.id.usernameEditText);
        passwordEditText = findViewById(R.id.passwordEditText);
        loginButton = findViewById(R.id.loginButton);

        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
//                usernameEditText.setText("alfredoo");
//                passwordEditText.setText("rahasia");
                doLogin();
            }
        });

    }

    private void doLogin() {
        apiApiService.loginRequest(usernameEditText.getText().toString(), passwordEditText.getText().toString())
                .enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        if (response.isSuccessful()) {
                            try {
                                JSONObject results = new JSONObject(response.body().string());
                                Log.d("##!", "onResponse: " + results);

                                if (results.getInt("status") == 200) {
                                    Toast.makeText(context, "Login Berhasil", Toast.LENGTH_SHORT).show();
                                    JSONObject user = results.getJSONObject("data");

                                    sharedPreferenceManager.saveString(SharedPreferenceManager.APP_ACCESS_TOKEN, user.getString("access_token"));
                                    sharedPreferenceManager.saveString(SharedPreferenceManager.APP_EMAIL, user.getString("email"));
                                    sharedPreferenceManager.saveString(SharedPreferenceManager.APP_USERNAME, user.getString("username"));
                                    sharedPreferenceManager.saveBoolean(SharedPreferenceManager.APP_LOGIN_STATE, true);
                                    sharedPreferenceManager.saveFloat(SharedPreferenceManager.APP_SALDO, (float) user.getDouble("balance"));

                                    apiApiService.setDeviceToken("Bearer " + sharedPreferenceManager.getAppAccessToken(), FirebaseInstanceId.getInstance().getToken())
                                            .enqueue(new Callback<ResponseBody>() {
                                                @Override
                                                public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                                                    Log.d("##", "onResponse: " + response);
                                                }

                                                @Override
                                                public void onFailure(Call<ResponseBody> call, Throwable t) {

                                                }
                                            });

                                    startActivity(new Intent(context, DashboardActivity.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                                    finish();

                                } else {
                                    Toast.makeText(context, "Login Gagal!", Toast.LENGTH_SHORT);
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            } catch (IOException e) {
                                e.printStackTrace();
                            }
                        }
                    }

                    @Override
                    public void onFailure(Call<ResponseBody> call, Throwable t) {

                    }
                });
    }
}
