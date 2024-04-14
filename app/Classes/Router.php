<?php

namespace App\Classes;

use Exception;

class Router
{
    private array $routes;

    /**
     * @throws Exception
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $this->run();
    }

    /**
     * @throws Exception
     */
    private function run(): void
    {
        $url = $this->parseUrl();
        $match = $this->matchRoute($url);

        if (empty($match)) {
            throw new Exception("Router not found");
        }

        new Controller($match[2], $this->getUrlParameters($url, $match[1]));
    }

    private function parseUrl(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function matchRoute(string $url): array|string
    {
        foreach ($this->routes as $route) {
            $arrayRoute = explode('/', $route[1]);
            $arrayUrl = explode('/', $url);

            if (count($arrayRoute) !== count($arrayUrl)) {
                continue;
            }
            if ($_SERVER['REQUEST_METHOD'] === $route[0]) {
                $isMatch = $this->urlMatch($url, $route[1]);
                if ($isMatch) {
                    return $route;
                }
            }
        }

        return [];
    }

    private function urlMatch(string $url, string $router): bool
    {
        $urlParams = $this->getUrlParameters($url);
        preg_match_all('/{(.*?)}/', $router, $matches);
        foreach ($urlParams as $key => $value) {
            $router = preg_replace("/{$matches[0][$key]}/", $value, $router);
        }

        return $router === $url;
    }

    private function getUrlParameters(string $url, string $router = null): array
    {
        preg_match_all('/\d+/', $url, $matches);
        if ($router) {
            preg_match_all('/{(.*?)}/', $router, $matchesParams);
            $params = [];
            foreach ($matchesParams[1] as $key => $match) {
                $match = preg_replace('/[{}]/', '', $match);
                $params[$match] = $matches[0][$key];
            }

            return $params;
        }
        return $matches[0];
    }
}
