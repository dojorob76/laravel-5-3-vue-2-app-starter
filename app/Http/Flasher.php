<?php

namespace App\Http;


class Flasher
{

    /**
     * Generate a flash message and add it to session storage.
     *
     * @param string $message - The message that should be displayed
     * @param string $title - The title of the message
     * @param string $level - The message status level ('success', 'info', 'warning', 'error', 'danger', 'question')
     * @param string $type - One of ('sweet_flash', 'sweet_dismiss', 'boot_flash', 'boot_dismiss')
     * @return mixed
     */
    public function flashMessage($message, $title, $level, $type)
    {
        return session()->flash($type, [
            'title'   => $title,
            'message' => $message,
            'level'   => $level
        ]);
    }

    /**
     * Flash message with defaults set.
     *
     * @param string $message
     * @param string $title
     * @param string $level
     * @param string $type
     * @return mixed
     */
    function message($message, $title = 'FYI', $level = 'info', $type = 'boot_flash')
    {
        return $this->flashMessage($message, $title, $level, $type);
    }
}