package com.tomislol.game;

import com.badlogic.gdx.ApplicationAdapter;
import com.badlogic.gdx.Game;
import com.badlogic.gdx.Gdx;
import com.badlogic.gdx.audio.Music;
import com.badlogic.gdx.graphics.GL20;
import com.badlogic.gdx.graphics.Texture;
import com.badlogic.gdx.graphics.g2d.SpriteBatch;
import com.tomislol.game.States.GameStateManager;
import com.tomislol.game.States.MenuState;

public class FlappyDemo extends ApplicationAdapter {
	public static final int WIDTH = 480;
	public static final int HEIGHT = 800;

	public static final String TITLE = "Flappy Bird";
	private GameStateManager gsm;
	private SpriteBatch batch;

	private Music music;


	@Override
	public void create () {
		batch = new SpriteBatch();
		gsm = new GameStateManager();
		music = Gdx.audio.newMusic(Gdx.files.internal("Atlas.mp3"));
		music.setLooping(true);
		music.setVolume(2f);
		music.play();
		Gdx.gl.glClearColor(1, 0, 0, 1);
		gsm.push(new MenuState(gsm));

	}

	@Override
	public void render () {
		Gdx.gl.glClear(GL20.GL_COLOR_BUFFER_BIT);
		gsm.update(Gdx.graphics.getDeltaTime());
		gsm.render(batch);
	}

	public void dispose()
	{
		super.dispose();
		music.dispose();
	}
}
