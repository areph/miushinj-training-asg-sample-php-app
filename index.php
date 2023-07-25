<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>EC2 Auto Scaling Test</title>
</head>

<body>
  <div id="content-outer">
    <center>
      <div id="content">
        <table border="0" width="50%" cellpadding="0" cellspacing="0" id="content-table">
          <tr>
            <th class="topleft"></th>
            <td id="tbl-border-top">&nbsp;</td>
            <th class="topright"></th>
          </tr>
          <tr>
            <td id="tbl-border-left"></td>
            <td>
              <div id="content-table-inner">
                <div id="table-content">
                  <?php

                  $ch = curl_init();

                  // Get our IMDSv2 Token
                  $headers = array('X-aws-ec2-metadata-token-ttl-seconds: 10');
                  $url = "http://169.254.169.254/latest/api/token";

                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                  curl_setopt($ch, CURLOPT_URL, $url);

                  $token = curl_exec($ch);
                  $headers = array('X-aws-ec2-metadata-token: ' . $token);
                  $url = "http://169.254.169.254/latest/meta-data/instance-id";

                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                  $instance_id = curl_exec($ch);

                  $headers = array('X-aws-ec2-metadata-token: ' . $token);
                  $url = "http://169.254.169.254/latest/meta-data/placement/availability-zone";

                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

                  $zone = curl_exec($ch);
                  ?>
                  <center>
                    <br />
                    <br />
                    <h2>EC2 Instance ID:
                      <?php echo $instance_id; ?>
                    </h2>
                    <h2>Zone:
                      <?php echo $zone; ?>
                    </h2>
                  </center>
                </div>
                <div class="clear"></div>
              </div>
            </td>
            <td id="tbl-border-right"></td>
          </tr>
          <tr>
            <th class="sized bottomleft"></th>
            <td id="tbl-border-bottom">&nbsp;</td>
            <th class="sized bottomright"></th>
          </tr>
        </table>
        <div class="clear">&nbsp;</div>
      </div>
    </center>
    <div class="clear">&nbsp;</div>
  </div>
  <div class="clear">&nbsp;</div>
</body>

</html>