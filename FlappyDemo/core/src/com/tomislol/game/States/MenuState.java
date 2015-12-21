package com.tomislol.game.States;

import com.badlogic.gdx.Gdx;
import com.badlogic.gdx.graphics.Texture;
import com.badlogic.gdx.graphics.g2d.SpriteBatch;
import com.tomislol.game.FlappyDemo;

/**
 * Created by Thomas X Mei on 12/19/2015.
 */
public class MenuState extends State {
    private Texture background;
    private Texture playBtn;
    public MenuState(GameStateManager gsm)
    {
        super(gsm);
        background = new Texture("bg.png");
        playBtn = new Texture("playbtn.png");
    }

    @Override
    public void handleInput()
    {
        if(Gdx.input.justTouched())
        {
            gsm.set(new PlateState(gsm));

        }
    }

    @Override
    public void update(float dt)
    {
        handleInput();
    }

    @Override
    public void render(SpriteBatch sb)
    {
        sb.begin();
        sb.draw(background, 0, 0, FlappyDemo.WIDTH, FlappyDemo.HEIGHT);
        sb.draw(playBtn, (FlappyDemo.WIDTH / 2) - (playBtn.getWidth() / 2), (FlappyDemo.HEIGHT / 2));
        sb.end();
    }

    @Override
    public void dispose() {
        background.dispose();
        playBtn.dispose();
    }
}
