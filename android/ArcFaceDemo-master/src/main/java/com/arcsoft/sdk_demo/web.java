package com.arcsoft.sdk_demo;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;

public class web extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getSupportActionBar().hide();
        setContentView(R.layout.activity_web);
        WebView webView = (WebView) findViewById(R.id.webview);//加载网页链接
        webView.loadUrl("http://www.lylhst.cn/zlsz/android/index.html");


    }
}
