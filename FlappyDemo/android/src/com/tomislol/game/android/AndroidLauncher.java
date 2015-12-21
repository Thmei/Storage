package com.tomislol.game.android;

import android.os.Bundle;

import com.badlogic.gdx.backends.android.AndroidApplication;
import com.badlogic.gdx.backends.android.AndroidApplicationConfiguration;
import com.tomislol.game.FlappyDemo;


public class AndroidLauncher extends AndroidApplication {
	@Override
	protected void onCreate (Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		AndroidApplicationConfiguration config = new AndroidApplicationConfiguration();
		//config.width = 480;
		//config.height = 800;
		//config.title = "FlappyDemo";
		initialize(new FlappyDemo(), config);

	}
}
