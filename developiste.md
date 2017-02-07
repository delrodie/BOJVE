==================================
===== BACKOFFICE DES WEBSITE =====
==================================

/*****
*** @Author: Delrodie AMOIKON
*** @version: 1.0.*
*** @Date: Mercredi 02 Novembre 2016
*****/

Ce projet consiste à concevoir le backoffice de mes sites
Il est composé de 5 tables dans la base ded données dont
  - RUBRIQUE: pour la gestion des categories d'articles
  - ARTICLES: pour la gestion des contenus des rubriques
  - IMAGE: pour la gestion des images d'illustration des articles et de la galerie photo
  - UTILISATEURS: pour la gestion des auteurs des articles
  - GROUPE: pour la gestion des groupe d'utilisateurs

Ainsi nous avons comme MLD
** - [*- RUBRIQUE(titre, description, statut)
         IMAGE(url, alt, statut)
         GROUPE(nom, role)
         UTILISATEUR(nom, login, motpass, mail, contact, #groupe)
         ARTICLE(titre, resume, contenu, tags, date_publication, date_modification, statut, #rubrique, #image, #auteur)
     -*]


1°/ **Implementation du template dans la base**
    Création du layout du backoffice dans App/resources/view
    ** - [*app/Resources/view/layout.html.twig*]

2°/ **Integration du bundle BazingaFakerBundle**
    Insertion dans composer.json
    ** - [*"require": {
              ...
              "willdurand/faker-bundle": "@stable"
          },*]

    Mise a jour du composer
    ** - [*composer update*]

    Activation du Bundle dans AppKernel
    [*if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
        ...
        $bundles[] = new Bazinga\Bundle\FakerBundle\BazingaFakerBundle();
    }*]

    Configuration dans config.yml
    [*bazinga_faker:
        orm: doctrine
        locale: fr_FR
        entities:*]

3°/ **Gestion de la classe Rurbique**
    Generation de l'entité Rubrique
    ** - [*- php bin/console doctrine:generate:entity AppBundle:Rubrique -*]

    Mise a jour de la base de données
    ** - [*- php bin/console doctrine:schema:update --force -*]

    Generation CRUD de l'entité Rubrique
    ** - [*- php bin/console doctrine:generate:crud AppBundle:Rubrique -*]

    Insertion des valeurs dans la table rubrique
    ** - [*- php bin/console faker:populate -*]

    Mise en page des templates (rubrique/new.html.twig, rubrique/index.html.twig, rubrique/edit.html.twig)

    Modification du form RubriqueType();
    ** - [*- $builder
          ->add('titre', TextType::class, array(
                'attr'  => array(
                    'class' => 'form-control'
                )
          ))
          ->add('description', TextareaType::class, array(
                'attr'  => array(
                    'class' => 'form-control'
                )
          ))
          ->add('statut')
          ; -*]

4°/ **Gestion de la classe Article**
    Generation de l'entité Article
    ** - [*- php bin/console doctrine:generate:entity AppBundle:Article -*]*

    Integration des lifeCycleCallbacks
    ** - [*- * @ORM\HasLifecycleCallbacks -*]
         [*-
             /**
             * @ORM\PrePersist
             */
             public function setPublicationAtValue()
             {
                $this->publicationAt = new \DateTime();
             }

             /**
             * @ORM\PreUpdate
             */
             public function setModificationAtValue()
             {
                $this->modificationAt = new \DateTime();
             }
          -*]

    Mise en relation avec l'entité Rubrique
    ** - [*-
            /**
             * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Rubrique")
             * @ORM\JoinTable(name="articles_rubriques",
             *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
             *      inverseJoinColumns={@ORM\JoinColumn(name="rubrique_id", referencedColumnName="id")}
             *      )
             */
             private $rubriques;
         -*]

    Mise a jour de la base de données
    ** - [*- php bin/console doctrine:schema:update --force -*]

    Generation crud de l'entité Article
    ** - [*- php bin/console doctrine:generate:crud AppBundle:Article -*]

    Mise en page de page des différentes views de article

5°/ **Gestion de la classe image**
    Generation de la classe
    ** - [*- php bin/console doctrine:generate:entity AppBundle:Image -*]

    Mise a jour de la base de données
    ** - [*- php bin/console doctrine:schema:update --force -*]

    Generation crud de l'entité Image
    ** - [*- php bin/console doctrine:generate:crud AppBundle:Image -*]

    Modification pour upload de l'image

    Mise en relation Article/Image
    ** - [*-
            /**
             * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist", "remove"})
             */
             private $image;
         -*]

    Mise a jour de la classe Article
    ** - [*- php bin/console doctrine:generate:entities AppBundle:Article -*]

    Mise a jour de la base de données
    ** - [*- php bin/console doctrine:schema:update --force -*]

    Integration de classe Image et ImageType dans ArticleType
    ** - [*-  use AppBundle\Entity\Image;
              use AppBundle\Form\ImageType;

              $builder
                    ...
                  ->add('image', ImageType::class)
              ;
        -*]

6°/ **Gestion des utilisateurs**
    Installation de FOSUserBundle
    ** - [*- composer require friendsofsymfony/user-bundle "~2.0@dev" -*]

    Activation du bundle dans AppKernel
    ** - [*- $bundles = [
            ...
            new FOS\UserBundle\FOSUserBundle(),
            ];
          -*]

    Creation des classe User.php et Group.php

    Personnalisation de la page de connexion

    Insertion des attributs
    loginCount: pour le nombre de connexion de l'utilisateur
    ** - [*- /**
             * @ORM\Column(type="integer", length=6, options={"default":0})
             */
            protected $loginCount = 0;
          -*]
    firstLogin: pour la première connexion
    ** - [*- /**
             * @var \DateTime
             *
             * @ORM\Column(type="datetime", nullable=true)
             */
            protected $firstLogin;
          -*]

    Mise a jour de la base de donnée
    ** - [*- php bin/console doctrine:cache:clear-metadata -*]
         [*- php bin/console doctrine:schema:update --force -*]

    Enregistrement de notre ecouteur de connexion
    ** - [*- services:
                login_listener:
                    class: 'AppBundle\Listener\LoginListener'
                    arguments: ['@fos_user.user_manager']
                    tags:
                        - { name: 'kernel.event_listener', event: 'security.interactive_login' }
                        - { name: 'kernel.listener', event: 'fos_user.security.implicit_login' }
          -*]

    Creation de notre ecouteur
    AppBundle\Listener\LoginListener.php

    Gestion de la classe Groupe
    ** - [*- php bin/console doctrine:generate:crud AppBundle:Group -*]

    Sauvegarde des entités (copie de repertoire AppBundle\Entity)

    Récupération des informations de mise en correspondance des entité tables
    ** - [*- php bin/console doctrine:mapping:import "AppBundle" xml -*]

    Modification de la classe GroupType
    ** - [*-
            $builder
                ->add('name', TextType::class, array(
                      'attr'  => array(
                          'class' => 'form-control'
                      )
                ))
                ->add('roles', ChoiceType::class, array(
                      'choices' => array(
                        'Auteur'  => 'ROLE_AUTEUR',
                        'Administrateur'  => 'ROLE_ADMIN'
                      ),
                      'multiple'  => true,
                      'expanded'  => true
                ))
                ;
          -*]

    Mise en page de l'entité Groupe
      creation de de template pour affichage des roles a cocher
      app/Resources/views/form/fields.html.twig

    Mise en page de l'entité User

7°/ **Installation de StofDoctrineExtensionsBundle**
    Installation de StofDoctrineExtensionsBundle
    ** - [*- https://github.com/Atlantic18/DoctrineExtensions/blob/master/doc/symfony2.md -*]


/*****
 *** Gestion du site de JVE Côte d'Ivoire
 *** @Author: Delrodie AMOIKON
 *** @version: 1.1.*
 *** @Date: Lundi 06 Fevrier 2017
*****/

1°/ **Gestion de la classe Presentation**
    Creation des classes Presentation et ImgPresentation
    ** - [*- php bin/console doctrine:generate:entity AppBundle:Presentation/ImgPresentation -*]

    Mise a jour de la base de données
    ** - [*- php bin/console doctrine:schema:update --force -*]

    Generation CRUD de la classe ImgPresentation
    ** - [*- php bin/console doctrine:generate:crud AppBundle:ImgPresentation -*]

    Generation CRUD de la classe Presentation
    ** - [*- php bin/console doctrine:generate:crud AppBundle:Presentation -*]
