<?php

namespace Selander\DemoApp\Controllers;

use Selander\DemoApp\Models\Post;
use Selander\Framework\Database\RepositoryFactoryInterface;
use Selander\Framework\Http\RequestInterface;
use Selander\Framework\Router\RouteInterface;
use Selander\Framework\Template\TemplateManagerInterface;
use Selander\Framework\Validator\Rules\Rule;
use Selander\Framework\Validator\ValidatorInterface;

class PostController
{
    /**
     * @var RepositoryFactoryInterface
     */
    private $postRepository;

    /**
     * @var TemplateManagerInterface
     */
    private $templateManager;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var RouteInterface
     */
    private $route;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * PostController constructor.
     * @param RepositoryFactoryInterface $repositoryFactory
     * @param TemplateManagerInterface $templateManager
     * @param ValidatorInterface $validator
     * @param RequestInterface $request
     * @param RouteInterface $route
     */
    public function __construct(
        RepositoryFactoryInterface $repositoryFactory,
        TemplateManagerInterface $templateManager,
        ValidatorInterface $validator,
        RequestInterface $request,
        RouteInterface $route
    ) {
        $this->postRepository = $repositoryFactory->create(Post::class);
        $this->templateManager = $templateManager;
        $this->validator = $validator;
        $this->request = $request;
        $this->route = $route;
    }

    /**
     * @Route\Path("/posts")
     * @Route\Method("GET")
     */
    public function index()
    {
        echo $this->templateManager->compile('template.php', [
            'title' => 'Posts',
            'body' => $this->templateManager->compile('posts/index.php', [
                'posts' => $this->postRepository->get(),
            ])
        ]);
    }

    /**
     * @Route\Path("/posts/create")
     * @Route\Method("GET")
     */
    public function create()
    {
        echo $this->templateManager->compile('template.php', [
            'title' => 'Create new post',
            'body' => $this->templateManager->compile('posts/create.php')
        ]);
    }

    /**
     * @Route\Path("/posts")
     * @Route\Method("POST")
     */
    public function store()
    {
        $this->guardWrite();

        $input = $this->request->post();

        $post = new Post();
        $post->title = $input->get('title');
        $post->content = $input->get('content');
        $this->postRepository->create($post);
    }

    /**
     * @Route\Path("/posts/:id")
     * @Route\Method("PUT")
     */
    public function update()
    {
        $this->guardWrite();

        $post = $this->postRepository->find(
            $this->route->wildcard('id')
        );

        $input = $this->request->post();
        $post->title = $input->get('title');
        $post->content = $input->get('content');
        $this->postRepository->update($post);
    }

    /**
     * @Route\Path("/posts/:id/edit")
     * @Route\Method("GET")
     */
    public function edit()
    {
        $post = $this->postRepository->find(
            $this->route->wildcard('id')
        );

        echo $this->templateManager->compile('template.php', [
            'title' => 'Show post',
            'body' => $this->templateManager->compile('posts/edit.php', [
                'post' => $post
            ])
        ]);
    }

    private function guardWrite()
    {
        $errors = $this->validator->validate($this->request->post()->all(), [
            Rule::required('title'),
            Rule::required('content'),

            Rule::disallowDigits('title'),

            Rule::disallowHtml('content'),
        ]);

        if (!empty($errors)) {
            http_response_code(400);
            print json_encode(['errors' => $errors]);
            exit();
        }
    }
}
