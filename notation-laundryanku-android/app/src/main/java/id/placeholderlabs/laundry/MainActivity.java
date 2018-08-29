package id.placeholderlabs.laundry;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

import com.google.firebase.FirebaseApp;
import com.google.firebase.iid.FirebaseInstanceId;

import id.placeholderlabs.laundry.util.SharedPreferenceManager;
import id.placeholderlabs.laundry.util.api.ApiService;
import id.placeholderlabs.laundry.util.api.UtilsApi;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainActivity extends AppCompatActivity {

    TextView helloTV;
    SharedPreferenceManager sharedPreferenceManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        SharedPreferenceManager sharedPreferenceManager = new SharedPreferenceManager(this);

        if (sharedPreferenceManager.getLoginState()) {
            Intent intent = new Intent(this, DashboardActivity.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            startActivity(intent);
            finish();
        } else {
            Intent intent = new Intent(this, LoginActivity.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            startActivity(intent);
            finish();
        }

    }
}
