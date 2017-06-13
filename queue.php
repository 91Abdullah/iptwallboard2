<?php


$qcalls = 0;
$queue = "1000";

require_once('./phpagi/phpagi-asmanager.php');

$asm = new AGI_AsteriskManager();
if($asm->connect("192.168.8.208:5038", "dashboard", "abdullah"))
{ 
	$result = $asm->Command("queue show $queue");
} else {
	echo "Error";
}

$asm->disconnect();

if(!empty($result['data'])) {

    $data = [];

    $new = explode("\n", $result['data']);
    //print_r($new);

    $pieces = explode(" ", $new[1]);
    $data['queue_name'] = $pieces[0];
    $data['calls'] = $pieces[2];
    $data['hold_time'] = trim($pieces[9], "(s");
    $data['talk_time'] = trim($pieces[11], "s");
    $data['call_answered'] = trim($pieces[14], "C:,");
    $data['call_unanswered'] = trim($pieces[15], "A:,");
    $data['service_level'] = trim($pieces[16], "SL:,");
    $data['total_calls'] = $data['call_answered'] + $data['call_unanswered'];
    $data['total_answered_percent'] = ($data['call_answered']/$data['total_calls']) * 100;
    $data['total_unanswered_percent'] = ($data['call_unanswered']/$data['total_calls']) * 100;

    $matches = [];
    $data['agents_online_count'] = 0;
    $data['agents_online_ring'] = 0;
    $data['agents_online_busy'] = 0;
    $data['agents_online_idle'] = 0;
    $data['agents_online_paused'] = 0;

    foreach ($new as $key => $line) {
        # code...
        if(preg_match('/Not in use/i', $line)) {
            $data['agents_online_count']++;
        }

        if(preg_match('/Ringing/i', $line)) {
            $data['agents_online_ring']++;
        }

        if(preg_match('/In use/', $line)) {
            $data['agents_online_busy']++;
        }

        if(preg_match('/Not in use/', $line) && !preg_match('/Unavailable/', $line)) {
            $data['agents_online_idle']++;
        }

        if(preg_match('/paused/', $line)) {
            $data['agents_online_paused']++;
        }
    }

}

//print_r($data['agents_online']);

?>

<script>
    var totalAnsweredPercent = "<?php echo $data['total_answered_percent'] ?>";
    var totalUnAnsweredPercent = "<?php echo $data['total_unanswered_percent'] ?>";
</script>

<div class="row">
                
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">ring_volume</i>
            </div>
            <div class="content">
                <div class="text">Queue</div>
                <div class="number"><?php echo $data['queue_name'] ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">call</i>
            </div>
            <div class="content">
                <div class="text">Calls</div>
                <div class="number"><?php echo $data['calls'] ?></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">volume_up</i>
            </div>
            <div class="content">
                <div class="text">Answered</div>
                <div class="number"><?php echo $data['call_answered'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">phone_missed</i>
            </div>
            <div class="content">
                <div class="text">Abandoned</div>
                <div class="number"><?php echo $data['call_unanswered'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">history</i>
            </div>
            <div class="content">
                <div class="text">Hold Time</div>
                <div class="number"><?php echo $data['hold_time'] ?> <small>sec</small></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">phone_in_talk</i>
            </div>
            <div class="content">
                <div class="text">Talk Time</div>
                <div class="number"><?php echo $data['talk_time'] ?> <small>sec</small></div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    

    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">account_box</i>
            </div>
            <div class="content">
                <div class="text">Login</div>
                <div class="number"><?php echo $data['agents_online_count'] ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">notifications_active</i>
            </div>
            <div class="content">
                <div class="text">Ring</div>
                <div class="number"><?php echo $data['agents_online_ring'] ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">record_voice_over</i>
            </div>
            <div class="content">
                <div class="text">Busy</div>
                <div class="number"><?php echo $data['agents_online_busy'] ?></div>
            </div>
        </div>
    </div>


    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">highlight_off</i>
            </div>
            <div class="content">
                <div class="text">Not Ready</div>
                <div class="number"><?php echo $data['agents_online_paused'] ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">perm_identity</i>
            </div>
            <div class="content">
                <div class="text">Idle</div>
                <div class="number"><?php echo $data['agents_online_idle'] ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="info-box-4">
            <div class="icon">
                <i class="material-icons col-red">insert_chart</i>
            </div>
            <div class="content">
                <div class="text">Service Level</div>
                <div id="serviceLevelVal" class="number"><?php echo $data['service_level'] ?></div>
            </div>
        </div>
    </div>
    

</div>