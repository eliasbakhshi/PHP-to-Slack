<?php

/* Get information and save them */
if(isset($_POST['Irisett'])){
    $monitor_description = $state = $slack_webhook_url = $slack_channel = $duration = 'UP';
    $organisation = 'https://www.beebyte.se/';
    $monitor_description = $_POST['monitor_description'];
    $state = strtoupper($_POST['state']);
    $organisation = $_POST['organisation'] ?? 'https://www.beebyte.se/';
    $slack_webhook_url = 'https://hooks.slack.com/services/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';
    $duration = $_POST['duration'];

    /*color the message (good = green, danger = red and warning = orange) */
    if($state === 'UP'){
        $colorOfMessage = 'good';
    } else if($state === 'DOWN'){
        $colorOfMessage = 'danger';
    } else{
        $colorOfMessage = 'warning';
    }

    /* Set a array in order to send it to Slack */
    $message = array('payload' => json_encode(array(
            'fallback' => '',
            'pretext' => '',
            'username' => 'Beebyte support',
            'text' => "HTTP monitor for $monitor_description has changed state to $state",
            'color' => "$colorOfMessage",
            'fields' => array(array(
                'title' => 'Duration',
                'value' => "$duration",
                'short' => false),
                array(
                    'title' => 'URL',
                    'value' => "$organisation",
                    'short' => false
                )
            )
        )
    ));

    /* Now you can send info to Slack */
    $cHandler = curl_init($slack_webhook_url);
    curl_setopt($cHandler, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cHandler, CURLOPT_POST, true);
    curl_setopt($cHandler, CURLOPT_POSTFIELDS, $message);
    curl_exec($cHandler);
    curl_close($cHandler);
}

///////////////////////////////////////////
// Make your message with variation 2
/*$message2 = array('payload' => json_encode(array(
    'fallback'=> 'A message from Elias: How is it going?',
    'pretext' => 'A message from Elias',
    'color'=> '#36a64f',
    'username' => 'support2',
//    'icon_url' => 'https://cdn.shopifycloud.com/hatchful-web/assets/6fcc76cfd1c59f44d43a485167fb3139.png',
    'author_name'=> 'BeeByte support',
    'author_link'=> 'http://beebyte.se/',
    'author_icon'=> '1616.jpg',
    'title'=> 'Title text is here',
    'title_link'=> 'https://www.google.com/',
    'text'=> 'text for the attachment is here',
    // Color for your message that show on the left of the message
    'color'=> '#36a64f',
    'fields'=> array(array(
            'title'=> 'title',
            'value'=> 'text to the title',
            'short'=> true)
    ),
    'image_url'=> '2.png',

    //thumb size should be less than 500k and use 75*75 pictures
    'thumb_url'=> '1616.png',

    //limit footer text size 300 characters
    'footer'=> 'Slack messages',

    // footer icon size is 16*16
    'footer_icon'=> '1616.png',
//    'ts'=> 123456789
 )));*/

///////////////////////////////////////////////////////////
// Make your message with variation 3
/* $message3 = array('payload' => json_encode(array(
        'text' => "HTTP monitor for $monitor_description has changed state to $state",
        'username' => 'Beebyte support',
        // Icon for your username
        'icon_url' => 'https://cdn.shopifycloud.com/hatchful-web/assets/6fcc76cfd1c59f44d43a485167fb3139.png',
        // You can use either username icon or emoji.
        'icon_emoji' => ':grin:'
    )));*/


///////////////////////////////////
// Second method to save info
/*$iInformation = $_POST;
foreach ($iInformation as $info){
        // $newinfo = explode(":", $info);
        $newinfo = str_replace("'","",explode(":", $info));
        $slackinfo = end($newinfo);
        switch ($newinfo[0]){
            case 'monitor_description':
                $monitor_description = $slackinfo;
                break;
            case 'state':
                $state = strtoupper($_POST['state']);
                break;
            case 'organisation':
                $organisation = $slackinfo;
                break;
            case 'slack_webhook_url':
                $slack_webhook_url = $slackinfo;
                break;
            case 'slack_channel':
                $slack_channel = $slackinfo;
                break;
            case 'duration':
                $duration = $slackinfo;
                break;
            default:
                echo "Please give a right information.";
        }

}*/
?>

