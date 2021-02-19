<?php

namespace App\Service;

use Twig\Environment;

class ContactService
{
    private $mailer;
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function sendMessage(array $contact)
    {
        $errors = $this->verifyDataForm($contact);

        if (! empty($errors)) {
            return $errors;
        }

        if (empty($errors)) {
            $message = (new \Swift_Message('Portfolio'))
                ->setFrom('devcg81@gmail.com')
                ->setTo('geoffroy.colpart81@gmail.com')
                ->setReplyTo($contact['email'])
                ->setBody(
                    $this->renderer->render(
                        'front/contact/email.html.twig',
                        [
                            'firtsname' => $contact['lastname'],
                            'lastname'  => $contact['name'],
                            'message'   => $contact['message']
                        ]
                    ),
                    'text/html'
                );

            $this->mailer->send($message);
        }
    }
    
    /**
     * verifyDataForm
     *
     * @param  array $contact
     * @return arry
     */
    private function verifyDataForm(array $contact): array
    {
        $errors = [];
        foreach($contact as $key => $value) {
            if (empty($value)) {
                $errors[$key] = "Ce champs est vide";
            }

            if ($key == "email") {
                if (! preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $value)) {
                    $errors[$key] = "Votre email n'est pas au bon format";
                }
            }
        }
        return $errors;
    }
}