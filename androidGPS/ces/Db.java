package com.harik.ces;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

import com.harik.lenovo2017.activits.R;

public class Db extends Activity {
EditText edchauffeur,edmatricule;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_db);

        edchauffeur= (EditText) findViewById(R.id.edchaufeur);
        edmatricule= (EditText) findViewById(R.id.edmatricule);
    }


    public void envoyer(View v){
//recuprer le texte : matricule et chaffeur
        String matricule = edmatricule.getText().toString();
        String chauffeur = edchauffeur.getText().toString();
        //on créer une intent de db vers le service
        Intent i= new Intent(Db.this,MyIntentService.class);
        //on y met des données
        i.putExtra("matricule",matricule);
        i.putExtra("chauffeur",chauffeur);
        //on démarre le service
        startService(i);

    }
}
