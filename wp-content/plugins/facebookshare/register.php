<?php
  global $wp;
  global $wpdb;
  global $wp_query;

  $fbshare = $wpdb->prefix . 'facebookshare';
  $media = $wpdb->prefix . 'posts';

  // Get the name
  $name = preg_replace('/name\//', '',$wp->request);

  // Get the image
  $query = "SELECT count(*) FROM $fbshare";
  $max = $wpdb->get_var($query);

  $num = rand(1, $max);

  $query = "SELECT $fbshare.media_id, $media.guid
            FROM $fbshare
            INNER JOIN $media
            ON $fbshare.media_id=$media.ID
            AND $fbshare.ID=$num";
  $img = $wpdb->get_row($query);
  $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );

  // use Facebook\Facebook;
  // use Facebook\FacebookApp;
  // use Facebook\FacebookRequest;
  // use Facebook\FacebookRequestException;
  // use Facebook\FacebookResponse;
  // $fbApp = new FacebookApp('173808106505387', 'c8227c30a6fb51594569a938b1e6349e');
  // $access_token = $fbApp->getAccessToken();
  // $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
  // $params = array(
  //     'scrape' => 'true',
  //     'id' => $current_url,
  // );
  //
  //
  // $fb = new Facebook([
  //   'app_id' => '173808106505387',
  //   'app_secret' => 'c8227c30a6fb51594569a938b1e6349e',
  //   'default_graph_version' => 'v2.10',
  // ]);
  //
  // $fb->setDefaultAccessToken($access_token);
  // // $fb->setDefaultAccessToken('173808106505387|oynIpFJYJ3Z8Xk35sjFYj5kH6-k');
  //
  // $requestRefresh = $fb->request('POST', '/', $params);
  //
  // $batch = [
  //   'refresh' => $requestRefresh
  // ];
  //
  // try {
  //   $responses = $fb->sendBatchRequest($batch);
  //   // $responses = $fb->getClient()->sendRequest($batch);
  // } catch(Facebook\Exceptions\FacebookResponseException $e) {
  //   // When Graph returns an error
  //   echo 'Graph returned an error: ' . $e->getMessage();
  //   exit;
  // } catch(Facebook\Exceptions\FacebookSDKException $e) {
  //   // When validation fails or other local issues
  //   echo 'Facebook SDK returned an error: ' . $e->getMessage();
  //   exit;
  // }
  //
  // print_r('<pre>');
  // print_r($response);
  // foreach ($responses as $key => $response) {
  //   print_r ($response);
  // }
  ?>

  <?php get_header(); ?>
  <script data="questo">
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '173808106505387',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.10'
    });
    var access_token = '';
    $.get(
      'https://graph.facebook.com/oauth/access_token?client_id=173808106505387&client_secret=c8227c30a6fb51594569a938b1e6349e&grant_type=client_credentials',
      function (response) {
        access_token = response.access_token;
        FB.api(
          '/',
          'POST',
          {"scrape":"true","id":"http://www.shortology.it/name/gianni","access_token":access_token},
          function(response) {
              console.log(response);
          }
        );
      }
    )

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  </script>
  <div class="bg dark-bg" style="text-align: left" id="blog">
    <div class="container">
        <div class="single-post">
          <div style="text-align: center">
            <div class="clear"></div>
            <a>
              <p class="post-title">Ciao <?php echo $wp_query->query_vars['sp_name'] ?> non sai che film guardare? Prova con questo!</p>
              <p></p>
            </a>
          </div>
          <p>
            <img src="<?php echo($img->guid) ?>" width="600" height="600" class="aligncenter size-full wp-image-2742"
            srcset="<?php echo($img->guid) ?> 600w, <?php echo($img->guid) ?> 300w"
            sizes="(max-width: 600px) 100vw, 600px"/>
          </p>
         </div>
     </div>
 </div>

<?php get_footer();
