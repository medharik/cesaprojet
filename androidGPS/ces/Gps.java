package com.harik.ces;

import android.app.Activity;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.provider.Settings;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.harik.lenovo2017.activits.R;

public class Gps extends Activity  implements LocationListener{
    Button bgps;
    TextView textlat,textlon;
LocationManager lm;
    Location position;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_gps);
//recuperation des vues graphiques
        textlat= (TextView) findViewById(R.id.textlat);
        textlon= (TextView) findViewById(R.id.textlon);
        bgps= (Button) findViewById(R.id.btngps);

        //demander le service de localisation depuis android
    lm= (LocationManager) getSystemService(LOCATION_SERVICE);

    }

  public void   trouvergps(View v){
//provider : NETWORK_LOCATION ou GPS_LOCATION
      //trouver le provider activé sinon on affiche fenetre parametres
      String provider="";
      if (lm.isProviderEnabled(LocationManager.GPS_PROVIDER)){
          provider=LocationManager.GPS_PROVIDER;
      }else if(lm.isProviderEnabled(LocationManager.NETWORK_PROVIDER)){
          provider=LocationManager.NETWORK_PROVIDER;
      }else {
          //affiche la fenetre de parametres de localisation
          startActivity(new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS));
      }

      Toast.makeText(this, "Le provider est "+provider, Toast.LENGTH_SHORT).show();
     position = lm.getLastKnownLocation(provider);

      if(position!=null){
          textlat.setText("Lat :"+position.getLatitude());
          textlon.setText("lon :"+position.getLongitude());
      }else{
          textlat.setText("Lat : 0.0");
          textlon.setText("lon : 0.0");
      }
lm.requestLocationUpdates(provider,1000,1,this);
  }
    @Override
    public void onLocationChanged(Location location) {
        textlat.setText("Lat : "+location.getLatitude());
        textlon.setText("lon : "+location.getLongitude());
    }
    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {

    }

    @Override
    public void onProviderDisabled(String provider) {

    }
}
