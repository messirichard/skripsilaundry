package id.placeholderlabs.laundry.util.api;

import java.util.List;

import id.placeholderlabs.laundry.models.Transactions;
import id.placeholderlabs.laundry.models.User;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;
import retrofit2.http.Path;

/**
 * Created by alfredo on 4/8/2018.
 */

public interface ApiService {

    @FormUrlEncoded
    @POST("users_api/login")
    Call<ResponseBody> loginRequest(@Field("username") String username,
                                    @Field("password") String password);

    @FormUrlEncoded
    @POST("users_api/set_device_token")
    Call<ResponseBody> setDeviceToken(@Header("Authorization") String accessToken,
                                    @Field("device_token") String deviceToken);

    @GET("transactions_api/user_transactions")
    Call<Transactions> userTransactions(@Header("Authorization") String accessToken);

    @Multipart
    @POST("transfer_report_api/do_upload")
    Call<ResponseBody> postImage(@Part MultipartBody.Part image, @Header("Authorization") String accessToken, @Part("transaction_id") RequestBody transactionId, @Part("type") RequestBody type);

    @GET("users_api/getsaldo")
    Call<ResponseBody> getSaldo(@Header("Authorization") String accessToken);
}
