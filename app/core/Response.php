<?php

namespace app\core;

class Response
{
    /**
     * Set the HTTP status code.
     */
    public function setStatusCode(int $code): self
    {
        http_response_code($code);
        return $this;
    }

    /**
     * Return a JSON response.
     */
    public function json(array $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Redirect to the previous page.
     */
    public function back(): void
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /**
     * Redirect with flash data.
     */
    public function with(string $key, $value): self
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    /**
     * Get flash data.
     */
    public function getFlash(string $key)
    {
        $value = $_SESSION[$key] ?? null;
        unset($_SESSION[$key]);
        return $value;
    }

    public function view(string $view, array $data = []): void
    {
        extract($data);
        require_once base_path('resources/views/' . $view . '.php');
    }
}
