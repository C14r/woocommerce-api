<?php

class ApiRoute
{
    public string $endpoint;
    public string $function;
    public array $parameters;

    public function __construct(string $route, stdClass $options)
    {
        $endpoint = str_replace('/wc/v3/', '', $route);
        $parameters = [];

        // match parameters
        preg_match_all('/\([^\)]+<([\w]+)>[^\)]+\)/m', $route, $matches, PREG_SET_ORDER, 0);

        // bulding endpoint / preparing parameters
        foreach ($matches as $match) {
            $endpoint = str_replace($match[0], ':'.$match[1], $endpoint);
            $parameters[$match[1]] = [];
        }

        // building parameters
        foreach ($parameters as $param => $parameter) {
            $name = ($param == 'group_id') ? 'group' : $param;

            $type = ApiBuilder::matchType($options->endpoints[0]->args->{$name}->type);
            $description = $options->endpoints[0]->args->{$name}->description;

            $parameters[$param] = compact('type', 'description');
        }

        $this->endpoint = $endpoint;
        $this->parameters = $parameters;
        $this->function = $this->buildFunctionName($endpoint);
    }

    private function buildFunctionName(string $endpoint): string
    {
        $name = '';
        $endpoint = str_replace('_', '/', $this->removeParameters($endpoint));
        $parts = explode('/', $endpoint);

        foreach ($parts as $part) {
            if (!empty($part)) {
                $name .= ucfirst($part);
            }
        }

        return lcfirst($name);
    }

    private function removeParameters(string $endpoint): string
    {
        return preg_replace('/\/:[\w]+/m', '', $endpoint);
    }

    public function __toString()
    {
        $php = $this->buildDocBlock().PHP_EOL;
        $php .= 'public function '.$this->function.'(';
        $php .= $this->buildParameters();
        $php .= '): self'.PHP_EOL;
        $php .= '{'.PHP_EOL;
        $php .= $this->buildContentBlock().PHP_EOL;
        $php .= '}'.PHP_EOL;

        return $php;
    }

    private function buildParameters(): string
    {
        $php = [];

        foreach ($this->parameters as $param => $options) {
            $php[] = $options['type'].' $'.$param;
        }

        return join(', ', $php);
    }

    private function buildDocBlock(): string
    {
        $doc = '/**'.PHP_EOL;

        $doc .= ' * API-Request for '.$this->endpoint.PHP_EOL;
        $doc .= PHP_EOL;

        foreach ($this->parameters as $param => $options) {
            $doc .= ' * @param '.$options['type'].' $'.$param.' '.$options['description'].PHP_EOL;
        }

        $doc .= ' * @return API'.PHP_EOL;
        $doc .= ' */';

        return $doc;
    }

    private function buildContentBlock(): string
    {
        $parameters = [];

        foreach ($this->parameters as $param => $options) {
            $parameters[] = $param;
        }

        if ($parameters) {
            return '    return $this->endpoint(\''.$this->endpoint.'\', compact(\''.join('\', \'', $parameters).'\'));';
        }

        return '    return $this->endpoint(\''.$this->endpoint.'\');';
    }
}

class ApiBuilder
{
    protected array $routes = [];
    protected array $enums = [];

    public function __construct(string $filename)
    {
        $api = json_decode(file_get_contents($filename));
        $this->routes = [];

        foreach ($api->routes as $route => $options) {
            $this->routes[] = new ApiRoute($route, $options);
        }

        /*
        $output = '';

        foreach ($api->routes as $route => $options) {
            foreach ($options->endpoints as $endpoint) {
                foreach ($endpoint->args as $arg => $options) {
                    if (property_exists($options, 'enum')) {
                        $output .= '// '.$route.PHP_EOL;
                        $output .= 'enum '.$arg.'{'.PHP_EOL;
                        
                        foreach ($options->enum as $value) {
                            $output .= '    '.$value.PHP_EOL;
                        }

                        $output .= '}'.PHP_EOL;
                    }
                }
            }
        }

        file_put_contents('enum.php', $output);
        */

        /*
        $output = '';

        foreach ($api->routes as $route => $options) {
            foreach ($options->endpoints as $endpoint) {
                foreach ($endpoint->args as $arg => $options) {
                    $type = property_exists($options, 'enum') ? 'enum' : $options->type ?? 'string'; 
                    $output .= $arg.' - '.$type.' - '.($options->default ?? '').PHP_EOL;
                }
            }
        }

        file_put_contents('args.php', $output);
        */
    }



    public static function matchType(string $type): string
    {
        switch ($type) {
            case 'integer':
                return 'int';
            case 'boolean':
                return 'bool';
            case 'string':
                return 'string';
            case 'object':
                return 'stdClass';
            default:
                return $type;
        }
    }

    public function __toString()
    {
        $php = '<?php'.PHP_EOL;
        $php .= PHP_EOL;
        $php .= 'declare(strict_types=1);'.PHP_EOL;
        $php .= PHP_EOL;
        $php .= 'namespace C14r\Woocommerce;'.PHP_EOL;
        $php .= PHP_EOL;
        $php .= 'class API'.PHP_EOL;
        $php .= '{'.PHP_EOL;

        foreach ($this->routes as $route) {
            $php .= (string)$route.PHP_EOL;
        }

        $php .= '}'.PHP_EOL;

        return $php;
    }
}

$api = new ApiBuilder('api.json');
//file_put_contents('api_gen.php', (string) $api);