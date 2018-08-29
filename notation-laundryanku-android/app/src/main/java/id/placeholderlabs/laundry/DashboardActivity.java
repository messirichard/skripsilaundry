package id.placeholderlabs.laundry;

import android.app.Fragment;
import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.util.Log;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.FrameLayout;
import android.widget.TextView;

import com.google.firebase.FirebaseApp;
import com.google.firebase.iid.FirebaseInstanceId;

import java.io.IOException;

import id.placeholderlabs.laundry.fragments.DashboardFragment;
import id.placeholderlabs.laundry.fragments.ProfileFragment;
import id.placeholderlabs.laundry.util.SharedPreferenceManager;

public class DashboardActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    android.support.v4.app.FragmentManager fragmentManager;
    android.support.v4.app.FragmentTransaction fragmentTransaction;
    FrameLayout dashboardContainer;
    SharedPreferenceManager sharedPreferenceManager;
    View mHeaderView;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        toolbar.setTitle("Dashboard");
        setSupportActionBar(toolbar);

        sharedPreferenceManager = new SharedPreferenceManager(getApplicationContext());

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        mHeaderView = navigationView.getHeaderView(0);
        TextView usernameNavigationView = mHeaderView.findViewById(R.id.username_navigationview);
        TextView emailNavigationView = mHeaderView.findViewById(R.id.email_navigationview);

        usernameNavigationView.setText(sharedPreferenceManager.getAppUsername());
        emailNavigationView.setText(sharedPreferenceManager.getAppEmail());

        sharedPreferenceManager = new SharedPreferenceManager(getApplicationContext());

        fragmentTransaction = getSupportFragmentManager().beginTransaction();
        fragmentTransaction.replace(R.id.dashboard_container, new DashboardFragment());
        fragmentTransaction.commit();
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.dashboard, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_refresh) {
            Intent intent = new Intent(getApplication(), DashboardActivity.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            startActivity(intent);
            finish();
            return true;
        } else

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        fragmentTransaction = getSupportFragmentManager().beginTransaction();

        switch (id) {
            case R.id.menu_dashboard:
                android.support.v4.app.Fragment dashboardFragment = new DashboardFragment();
                fragmentTransaction.replace(R.id.dashboard_container, dashboardFragment);
                break;
            case R.id.nav_logout:
                Log.d("##", "onOptionsItemSelected: Logout");
                sharedPreferenceManager.clear();
                try {
                    FirebaseInstanceId.getInstance().deleteInstanceId();
                } catch (IOException e) {
                    e.printStackTrace();
                }

                Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);
                break;
        }

        fragmentTransaction.addToBackStack(null);
        fragmentTransaction.commit();

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    public void setToolbarTitle(String title) {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        toolbar.setTitle(title);
    }
}
