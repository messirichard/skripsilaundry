package id.placeholderlabs.laundry.util.api;

/**
 * Created by alfredo on 4/8/2018.
 */

public class UtilsApi {
    public static final String BASE_URL_API = "http://laundry.skripsii.net/";

    // Mendeklarasikan Interface BaseApiService
    public static ApiService getAPIService(){
        return RetrofitClient.getClient(BASE_URL_API).create(ApiService.class);
    }
}
