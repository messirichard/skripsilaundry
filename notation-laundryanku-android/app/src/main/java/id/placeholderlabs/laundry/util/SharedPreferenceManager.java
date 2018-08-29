package id.placeholderlabs.laundry.util;

import android.content.Context;
import android.content.SharedPreferences;

/**
 * Created by alfredo on 4/8/2018.
 */

public class SharedPreferenceManager {

    public static final String APP_NAME = "Laundryan";

    public static final String APP_USERNAME = "AppUsername";
    public static final String APP_EMAIL = "AppEmail";
    public static final String APP_DEVICE_TOKEN = "AppDeviceToken";
    public static final String APP_ACCESS_TOKEN = "AppAccessToken";
    public static final String APP_SALDO = "AppSaldo";

    public static final String APP_LOGIN_STATE = "AppLoginState";

    SharedPreferences sharedPreference;
    SharedPreferences.Editor sharedPreferenceEditor;

    public SharedPreferenceManager(Context context){
        sharedPreference = context.getSharedPreferences(APP_NAME, Context.MODE_PRIVATE);
        sharedPreferenceEditor = sharedPreference.edit();
    }

    public void saveString(String key, String value){
        sharedPreferenceEditor.putString(key, value);
        sharedPreferenceEditor.commit();
    }

    public void saveInt(String key, int value){
        sharedPreferenceEditor.putInt(key, value);
        sharedPreferenceEditor.commit();
    }

    public void saveBoolean(String key, boolean value){
        sharedPreferenceEditor.putBoolean(key, value);
        sharedPreferenceEditor.commit();
    }

    public void saveFloat(String key, float value){
        sharedPreferenceEditor.putFloat(key, value);
        sharedPreferenceEditor.commit();
    }

    public String getAppUsername(){
        return sharedPreference.getString(APP_USERNAME, "");
    }

    public String getAppEmail(){
        return sharedPreference.getString(APP_EMAIL, "");
    }

    public Boolean getLoginState(){
        return sharedPreference.getBoolean(APP_LOGIN_STATE, false);
    }

    public String getAppAccessToken() {
        return sharedPreference.getString(APP_ACCESS_TOKEN, "");
    }

    public Float getAppSaldo() {
        return sharedPreference.getFloat(APP_SALDO, (float) 0.0);
    }


    public void clear() {
        saveString(APP_USERNAME, "");
        saveString(APP_ACCESS_TOKEN, "");
        saveString(APP_DEVICE_TOKEN, "");
        saveString(APP_EMAIL, "");
        saveBoolean(APP_LOGIN_STATE, false);
        saveFloat(APP_SALDO, (float) 0.0);
    }
}