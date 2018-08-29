package id.placeholderlabs.laundry;

import android.content.Intent;
import android.util.Log;

import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.FirebaseInstanceIdService;

import id.placeholderlabs.laundry.util.SharedPreferenceManager;
import id.placeholderlabs.laundry.util.api.ApiService;
import id.placeholderlabs.laundry.util.api.UtilsApi;
import okhttp3.ResponseBody;
import okhttp3.internal.Util;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

/**
 * Created by alfredo on 4/2/2018.
 */

public class FirebaseIDService extends FirebaseInstanceIdService {
    private static final String TAG = "FirebaseIDService";


    @Override
    public void onTokenRefresh() {
        // Get updated InstanceID token.
        String refreshedToken = FirebaseInstanceId.getInstance().getToken();
        Log.d(TAG, "Refreshed token: " + refreshedToken);

        // TODO: Implement this method to send any registration to your app's servers.
        sendRegistrationToServer(refreshedToken);
    }

    /**
     * Persist token to third-party servers.
     *
     * Modify this method to associate the user's FCM InstanceID token with any server-side account
     * maintained by your application.
     *
     * @param token The new token.
     */
    private void sendRegistrationToServer(String token) {
        // Add custom implementation, as needed.
        SharedPreferenceManager sharedPreferenceManager = new SharedPreferenceManager(getApplicationContext());
        ApiService apiService = UtilsApi.getAPIService();
        Log.d(TAG, "sendRegistrationToServer: now");
        if (sharedPreferenceManager.getLoginState()) {
            apiService.setDeviceToken("Bearer " + sharedPreferenceManager.getAppAccessToken(), token)
                    .enqueue(new Callback<ResponseBody>() {
                        @Override
                        public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                            Log.d(TAG, "onResponse: " + response);
                        }

                        @Override
                        public void onFailure(Call<ResponseBody> call, Throwable t) {

                        }
                    });
        }
    }
}
