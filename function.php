
function sc_send($comment_id)
{
    $text = '提醒主人，又有小伙伴来留言了';
    $comment = get_comment($comment_id);
    $desp = $comment->comment_content;
    $key = 'SCU93083T10098b80287a00e6c030746a8f1275dd5e8daf988b5b1';
    $postdata = http_build_query(
        array(
            'text' => $text,
            'desp' => $desp
        )
    );
    $opts = array('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    $context = stream_context_create($opts);
    return $result = file_get_contents('https://sc.ftqq.com/'.$key.'.send', false, $context);
}
add_action('comment_post', 'sc_send', 19, 2);
