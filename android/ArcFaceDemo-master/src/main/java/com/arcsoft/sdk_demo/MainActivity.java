package com.arcsoft.sdk_demo;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.ContentUris;
import android.content.ContentValues;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.os.Handler;
import android.os.Message;
import android.provider.DocumentsContract;
import android.provider.MediaStore;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;
import android.support.v7.app.AppCompatActivity;
import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class MainActivity extends AppCompatActivity implements OnClickListener {
	private final String TAG = this.getClass().toString();
	public static boolean state=true;
	HttpClient client;
	public String[] res;
	public String[] res2;
	public int sign=0;
	public Handler myHandler;
	Button content;
	ImageView image;
	Bitmap bitmap;
	boolean temp=false;

	private static final int REQUEST_CODE_IMAGE_CAMERA = 1;
	private static final int REQUEST_CODE_IMAGE_OP = 2;
	private static final int REQUEST_CODE_OP = 3;

	/* (non-Javadoc)
	 * @see android.app.Activity#onCreate(android.os.Bundle)
	 */
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		getSupportActionBar().hide();
		this.setContentView(R.layout.main_test);
		View v = this.findViewById(R.id.button1);

		v.setOnClickListener(this);
		if(state){
			v.performClick();
		}

		v = this.findViewById(R.id.button2);
		v.setOnClickListener(this);
		ImageView imageView=this.findViewById(R.id.imageView2);
		imageView.setOnClickListener(new View.OnClickListener(){

			@Override
			public void onClick(View view) {
				Intent intent=new Intent(MainActivity.this, web.class);
				startActivity(intent);
			}
		});
	}

	/* (non-Javadoc)
	 * @see android.app.Activity#onDestroy()
	 */
	@Override
	protected void onDestroy() {
		// TODO Auto-generated method stub
		super.onDestroy();
	}

	@Override
	//再一次返回执行
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);

		if (requestCode == REQUEST_CODE_IMAGE_OP && resultCode == RESULT_OK) {
			Uri mPath = data.getData();
			String file = getPath(mPath);
			Bitmap bmp = Application.decodeImage(file);
			if (bmp == null || bmp.getWidth() <= 0 || bmp.getHeight() <= 0 ) {
				Log.e(TAG, "error");
			} else {
				Log.i(TAG, "bmp [" + bmp.getWidth() + "," + bmp.getHeight());
			}
			startRegister(bmp, file);
		} else if (requestCode == REQUEST_CODE_OP) {
			Log.i(TAG, "RESULT =" + resultCode);
			if (data == null) {
				return;
			}
			Bundle bundle = data.getExtras();
			String path = bundle.getString("imagePath");
			Log.i(TAG, "path="+path);
		} else if (requestCode == REQUEST_CODE_IMAGE_CAMERA && resultCode == RESULT_OK) {
			Uri mPath = ((Application)(MainActivity.this.getApplicationContext())).getCaptureImage();
			String file = getPath(mPath);
			Bitmap bmp = Application.decodeImage(file);
			startRegister(bmp, file);
		}
	}

	@Override
	public void onClick(View paramView) {
		// TODO Auto-generated method stub
		switch (paramView.getId()) {
			case R.id.button2:
				if( ((Application)getApplicationContext()).mFaceDB.mRegister.isEmpty() ) {
					Toast.makeText(this, "没有注册人脸，请先注册！", Toast.LENGTH_SHORT).show();
				} else {
						new AlertDialog.Builder(this)
							.setTitle("请选择相机")
							.setIcon(android.R.drawable.ic_dialog_info)
							.setItems(new String[]{"后置相机", "前置相机"}, new DialogInterface.OnClickListener() {
										@Override
										public void onClick(DialogInterface dialog, int which) {
											startDetector(which);
										}
									})
							.show();
				}
				break;
			case R.id.button1:
			    sign=0;
			    state=false;
				Toast.makeText(getBaseContext(), "系统正在更新请稍后", Toast.LENGTH_SHORT).show();
				startUrlCheck();
				myHandler = new Handler(){
					public void handleMessage(Message msg){
						if(msg.what == 0x123){

							for(int i=0;i<res.length;i++){
								new Task().execute("http://www.lylhst.cn/zlsz/"+res[i]);
							}
						}
                    };
					};
				break;
			default:;
		}
	}

	/**
	 * @param uri
	 * @return
	 */
	private String getPath(Uri uri) {
		if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.KITKAT) {
			if (DocumentsContract.isDocumentUri(this, uri)) {
				// ExternalStorageProvider
				if (isExternalStorageDocument(uri)) {
					final String docId = DocumentsContract.getDocumentId(uri);
					final String[] split = docId.split(":");
					final String type = split[0];

					if ("primary".equalsIgnoreCase(type)) {
						return Environment.getExternalStorageDirectory() + "/" + split[1];
					}

					// TODO handle non-primary volumes
				} else if (isDownloadsDocument(uri)) {

					final String id = DocumentsContract.getDocumentId(uri);
					final Uri contentUri = ContentUris.withAppendedId(
							Uri.parse("content://downloads/public_downloads"), Long.valueOf(id));

					return getDataColumn(this, contentUri, null, null);
				} else if (isMediaDocument(uri)) {
					final String docId = DocumentsContract.getDocumentId(uri);
					final String[] split = docId.split(":");
					final String type = split[0];

					Uri contentUri = null;
					if ("image".equals(type)) {
						contentUri = MediaStore.Images.Media.EXTERNAL_CONTENT_URI;
					} else if ("video".equals(type)) {
						contentUri = MediaStore.Video.Media.EXTERNAL_CONTENT_URI;
					} else if ("audio".equals(type)) {
						contentUri = MediaStore.Audio.Media.EXTERNAL_CONTENT_URI;
					}

					final String selection = "_id=?";
					final String[] selectionArgs = new String[] {
							split[1]
					};

					return getDataColumn(this, contentUri, selection, selectionArgs);
				}
			}
		}
		String[] proj = { MediaStore.Images.Media.DATA };
		Cursor actualimagecursor = this.getContentResolver().query(uri, proj, null, null, null);
		int actual_image_column_index = actualimagecursor.getColumnIndexOrThrow(MediaStore.Images.Media.DATA);
		actualimagecursor.moveToFirst();
		String img_path = actualimagecursor.getString(actual_image_column_index);
		String end = img_path.substring(img_path.length() - 4);
		if (0 != end.compareToIgnoreCase(".jpg") && 0 != end.compareToIgnoreCase(".png")) {
			return null;
		}
		return img_path;
	}

	/**
	 * @param uri The Uri to check.
	 * @return Whether the Uri authority is ExternalStorageProvider.
	 */
	public static boolean isExternalStorageDocument(Uri uri) {
		return "com.android.externalstorage.documents".equals(uri.getAuthority());
	}

	/**
	 * @param uri The Uri to check.
	 * @return Whether the Uri authority is DownloadsProvider.
	 */
	public static boolean isDownloadsDocument(Uri uri) {
		return "com.android.providers.downloads.documents".equals(uri.getAuthority());
	}

	/**
	 * @param uri The Uri to check.
	 * @return Whether the Uri authority is MediaProvider.
	 */
	public static boolean isMediaDocument(Uri uri) {
		return "com.android.providers.media.documents".equals(uri.getAuthority());
	}

	/**
	 * Get the value of the data column for this Uri. This is useful for
	 * MediaStore Uris, and other file-based ContentProviders.
	 *
	 * @param context The context.
	 * @param uri The Uri to query.
	 * @param selection (Optional) Filter used in the query.
	 * @param selectionArgs (Optional) Selection arguments used in the query.
	 * @return The value of the _data column, which is typically a file path.
	 */
	public static String getDataColumn(Context context, Uri uri, String selection,
									   String[] selectionArgs) {

		Cursor cursor = null;
		final String column = "_data";
		final String[] projection = {
				column
		};

		try {
			cursor = context.getContentResolver().query(uri, projection, selection, selectionArgs,
					null);
			if (cursor != null && cursor.moveToFirst()) {
				final int index = cursor.getColumnIndexOrThrow(column);
				return cursor.getString(index);
			}
		} finally {
			if (cursor != null)
				cursor.close();
		}
		return null;
	}

	/**
	 * @param mBitmap
	 */
	private void startRegister(Bitmap mBitmap, String file) {
		Intent it = new Intent(MainActivity.this, RegisterActivity.class);
		Bundle bundle = new Bundle();
		bundle.putString("imagePath", file);
		bundle.putString("pname", res2[sign]);
		sign=sign+1;
		it.putExtras(bundle);
		startActivityForResult(it, REQUEST_CODE_OP);
	}

	private void startDetector(int camera) {
		Intent it = new Intent(MainActivity.this, DetecterActivity.class);
		it.putExtra("Camera", camera);
		startActivityForResult(it, REQUEST_CODE_OP);
	}
	public Bitmap GetImageInputStream(String imageurl){
		URL url;
		HttpURLConnection connection=null;
		Bitmap bitmap=null;
		try {
			url = new URL(imageurl);
			connection=(HttpURLConnection)url.openConnection();
			connection.setConnectTimeout(6000); //超时设置
			connection.setDoInput(true);
			connection.setUseCaches(false); //设置不使用缓存
			InputStream inputStream=connection.getInputStream();
			bitmap=BitmapFactory.decodeStream(inputStream);
			inputStream.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return bitmap;
	}
	Handler handler=new Handler(){
		public void handleMessage(android.os.Message msg) {

		};
	};

	class Task extends AsyncTask<String, Integer, Void> {

		protected Void doInBackground(String... params) {
			bitmap=GetImageInputStream((String)params[0]);
			return null;
		}

		protected void onPostExecute(Void result) {
			super.onPostExecute(result);




			Message message=new Message();
			message.what=0x123;

			handler.sendMessage(message);
			SavaImage(bitmap, Environment.getExternalStorageDirectory().getPath()+"/Test");
			if(sign==res2.length){
				Toast.makeText(getBaseContext(), "系统更新完毕", Toast.LENGTH_SHORT).show();
			}

		}

	}


	/**
	 * 保存位图到本地
	 * @param bitmap
	 * @param path 本地路径
	 * @return void
	 */
	public void SavaImage(Bitmap bitmap, String path){

		File file=new File(path);
		FileOutputStream fileOutputStream=null;
		//文件夹不存在，则创建它
		if(!file.exists()){
			file.mkdir();
		}
		try {
			String name=path+"/"+System.currentTimeMillis()+".png";
			fileOutputStream=new FileOutputStream(name);
			bitmap.compress(Bitmap.CompressFormat.JPEG, 100,fileOutputStream);
			fileOutputStream.close();
			Bitmap bmp = Application.decodeImage(name);
			startRegister(bmp,name);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	private void startUrlCheck()
	{
		new Thread(){
			public void run(){
				client = new DefaultHttpClient();
				StringBuilder builder = new StringBuilder();
				HttpGet myget = new HttpGet("http://www.lylhst.cn/zlsz/a-p.php");
//HttpGet myget = new HttpGet("http://www.crazyit.org"); 
				try {
					//Toast.makeText(getBaseContext(), "进来了", Toast.LENGTH_SHORT).show();
					HttpResponse response = client.execute(myget);
					HttpEntity entity = response.getEntity();
					BufferedReader reader = new BufferedReader(new InputStreamReader(entity.getContent()));
					for (String s = reader.readLine(); s != null; s = reader.readLine()) {
						builder.append(s);
					}
					JSONObject jsonObject = new JSONObject(builder.toString());
					int n=jsonObject.length();
					String shu[]=new String[n/2];
					String shu2[]=new String[n/2];
					for(int i=1;i<=n/2;i++){
						shu[i-1]=jsonObject.getString(i+"");
						shu2[i-1]=jsonObject.getString("name"+i);
					}
					res = shu;
					res2 = shu2;
					Message msg = new Message();
					msg.what = 0x123;
					msg.obj = res;
					myHandler.sendMessage(msg);

				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		}.start();
	}
}

