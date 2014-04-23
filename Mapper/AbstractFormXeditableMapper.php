<?php

namespace Ibrows\XeditableBundle\Mapper;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractFormXeditableMapper extends AbstractXeditableMapper
{

    /**
     * @var FormInterface
     */
    protected $form;


    /**
     * @var bool
     */
    protected $renderFormPrototype = true;

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param boolean $renderFormPrototype
     */
    public function setRenderFormPrototype($renderFormPrototype)
    {
        $this->renderFormPrototype = $renderFormPrototype;
    }


    /**
     * @param string $path
     * @param null $form
     * @param bool $removeOther
     * @return FormInterface
     */
    protected function getFormByPath($path, $form = null, $removeOther = false)
    {
        if (!$form) {
            $form = $this->form;
        }

        if (!$path) {
            return $form;
        }

        $parts = explode(".", $path);
        while (!is_null($name = array_shift($parts))) {
            if (!$form->has($name)) {
                throw new \Exception("$name not found in form {$form->getName()}");
            }
            if ($removeOther) { //remove other childs to save time & reduce db requests
                foreach ($form->all() as $childname => $child) {
                    if ($name != $childname) {
                        $form->remove($childname);
                    }
                }
            }
            $form = $form->get($name);
        }

        return $form;
    }

    /**
     * @param FormInterface $form
     * @param array $attributes
     * @param array $options
     * @return array
     */
    protected function getEditParameters(FormInterface $form, array $attributes = array(), array $options = array())
    {
        return array(
            'form' => $form->createView(),
            'attributes' => $attributes,
            'options' => $options
        );
    }

    protected function getErrorTemplate()
    {
        return 'IbrowsXeditableBundle::xeditableformerrors.html.twig';
    }

    protected function renderError($subform = null)
    {
        $params = array(
            'form' => $this->form->createView(),
        );
        if ($subform) {
            $params['subform'] = $subform->createView();
        }

        return new Response($this->engine->render(
            $this->getErrorTemplate(),
            $params
        ), 400);
    }

    protected function getRenderTemplate($options)
    {
        return isset($options['template']) ? $options['template'] : 'IbrowsXeditableBundle::xeditable.html.twig';
    }


    protected function getRenderFormPrototype($options)
    {
        return  array_key_exists('renderFormPrototype',$options) ? $options['renderFormPrototype'] : $this->renderFormPrototype;
    }

    protected function getFormTemplate($options)
    {
        return isset($options['template']) ? $options['template'] : 'IbrowsXeditableBundle::xeditableform.html.twig';
    }

}