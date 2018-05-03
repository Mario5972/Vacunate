package com.example.mario5972.vacunate;

import android.content.Intent;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class RegistroCartillaActivity extends AppCompatActivity {

    Button fab;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registro_cartilla);

        fab = (Button) findViewById(R.id.cartilla_siguiente);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), RegistroVacunasActivity.class);
                startActivity(intent);
            }
        });

    }
}
