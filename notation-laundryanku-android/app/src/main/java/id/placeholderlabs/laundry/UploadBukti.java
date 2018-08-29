package id.placeholderlabs.laundry;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;


import com.google.gson.Gson;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.io.IOException;
import java.io.InputStream;

import gun0912.tedbottompicker.TedBottomPicker;
import id.placeholderlabs.laundry.util.SharedPreferenceManager;
import id.placeholderlabs.laundry.util.api.ApiService;
import id.placeholderlabs.laundry.util.api.UtilsApi;
import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class UploadBukti extends AppCompatActivity {

    private ImageView imageView;
    private TextView textView;
    Context mContext;
    Uri imageUri;
    SharedPreferenceManager sharedPreferenceManager;
    String transactionTypeExtra;
    String transactionIdExtra;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload_bukti);
        Button btnUpload = findViewById(R.id.btn_upload);
        imageView = findViewById(R.id.imagePreview);

        textView = findViewById(R.id.text_view_chooser);
        mContext = getApplicationContext();

        sharedPreferenceManager = new SharedPreferenceManager(getApplicationContext());

        transactionTypeExtra = getIntent().getStringExtra("TYPE");
        transactionIdExtra = getIntent().getStringExtra("TRANSACTION_ID");

        final ApiService apiService = UtilsApi.getAPIService();

        final TedBottomPicker tedBottomPicker = new TedBottomPicker.Builder(UploadBukti.this)
                .setOnImageSelectedListener(new TedBottomPicker.OnImageSelectedListener() {
                    @Override
                    public void onImageSelected(Uri uri) {
                        imageView.setImageURI(uri);
                        imageUri = uri;
                        if (imageView.getVisibility() == View.GONE) {
                            imageView.setVisibility(View.VISIBLE);
                            textView.setVisibility(View.GONE);
                        }
                    }
                })
                .create();

        textView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                tedBottomPicker.show(getSupportFragmentManager());
            }
        });

        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                tedBottomPicker.show(getSupportFragmentManager());
            }
        });

        btnUpload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (imageUri != null) {
                    File image = new File(imageUri.getPath());
                    RequestBody reqFile = RequestBody.create(MediaType.parse("image/*"), image);
                    MultipartBody.Part imagePart = MultipartBody.Part.createFormData("userfile", image.getName(), reqFile);
                    RequestBody transactionId = RequestBody.create(MediaType.parse("text/plain"), transactionIdExtra);
                    RequestBody type = RequestBody.create(MediaType.parse("text/plain"), transactionTypeExtra);

                    apiService.postImage(imagePart, "Bearer " + sharedPreferenceManager.getAppAccessToken(), transactionId, type)
                            .enqueue(new Callback<ResponseBody>() {
                                @Override
                                public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                                    try {
                                        JSONObject results = new JSONObject(response.body().string());

                                        if (results.getInt("status") == 200) {
                                            Toast.makeText(getApplicationContext(), "Upload Berhasil", Toast.LENGTH_SHORT).show();
                                        } else {
                                            Toast.makeText(getApplicationContext(), "Upload Gagal", Toast.LENGTH_SHORT).show();
                                        }

                                    } catch (JSONException e) {
                                        e.printStackTrace();
                                    } catch (IOException e) {
                                        e.printStackTrace();
                                    }
                                }

                                @Override
                                public void onFailure(Call<ResponseBody> call, Throwable t) {
                                    t.printStackTrace();
                                }
                            });
                } else {
                    Toast.makeText(getApplicationContext(), "Masukkan gambar terlebih dahulu", Toast.LENGTH_SHORT).show();
                }
            }
        });

    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        super.onActivityResult(requestCode, resultCode, data);
    }

    public void onPickImage(View view) {
    }
}
