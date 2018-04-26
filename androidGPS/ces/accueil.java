package com.harik.ces;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import com.harik.lenovo2017.activits.R;

public class accueil extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_accueil);
    }

    public void afficherdb(View v){
    // intent i

        Intent i=new Intent(accueil.this,Db.class);
        //on demarre l'activité
        startActivity(i);

        
    }
public void affichergps(View v){
//les intents sont des objets permettant  d'échanger des messages entre composant android
    Intent i=new Intent(accueil.this,Gps.class);
   //on demarre l'activité
    startActivity(i);
}


}
