<?php

function parseMessage($messages)
{
    $result = '<div class="message">';

    if (!empty($messages)) {
        foreach ($messages as $message_type => $value) {
            //fetch & generate data
            $result .= parseMessageByType($message_type, $value);
        }
    }

    $result .= '</div>';

    return $result;
}

function parseMessageByType($type, $msg_val)
{
    if (empty($msg_val)
        || !is_array($msg_val)
    ) {
        return '';
    }

    $class = parseClassByMsgType($type);

    $message_return = '';
//    dd($msg_val);
    foreach ($msg_val as $selector_element => $msg) {
        $message_return .= '<div id="alert_' . $selector_element . '" class="' . $class . ' fade in" data-selector="' . $selector_element . '">';
        $message_return .= '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        $message_return .= $msg;
        $message_return .= '</div>';
    }

    return $message_return;
}

function parseClassByMsgType($msg_type)
{
    $class = 'alert';

    switch ($msg_type) {
        case MESSAGE_TYPE_SUCCESS:
            $class .= ' alert-success';
            break;
        case MESSAGE_TYPE_ERROR:
            $class .= ' alert-danger';
            break;
        case MESSAGE_TYPE_WARNING:
            $class .= ' alert-warning';
            break;
        case MESSAGE_TYPE_INFO:
            $class .= ' alert-info';
            break;
        default:
            $class .= ' alert-info';
            break;
    }

    return $class;
}
