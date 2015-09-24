<?php

namespace MRS\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="MRS\ModelBundle\Repository\PostRepository")
 */
class Post extends Timestampable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank
     */
    private $content;

    /**
     * @var Author
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    private $author;


    /**
     * @var
     * @ORM\Column(name="cover",type="string",length=255,nullable=true)
     */
    private $cover;

    /**
     * @Assert\File(maxSize="1000000")
     */
    private $file;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"}, unique=false)
     * @ORM\Column(length=255)
     */
    private $slug;

    /**
     * @return string
     */
    public function getCover()
    {
        return $this->getCover();
    }

    /**
     * @param string
     * @return Image
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile|null $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    protected function getUploadPath()
    {
        return 'uploads/covers';
    }

    protected function getUploadAbsolutePath()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadPath();
    }

    public function getCoverWeb()
    {
        return null === $this->getCover()
            ? null
            : $this->getUploadPath() . '/' . $this->getCover();
    }

    public function getCoverAbsolute()
    {
        return null === $this->getCover()
            ? null
            : $this->getUploadAbsolutePath() . '/' . $this->getCover();
    }

    public function upload()
    {
        if(null === $this->getFile()){
            return;
        }

        $filename = $this->getFile()->getClientOriginalName();
        $this->getFile()->move($this->getUploadAbsolutePath(),$filename);
        $this->setCover($filename);
        $this->setFile();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * Set author
     *
     * @param \MRS\ModelBundle\Entity\Author $author
     *
     * @return Post
     */
    public function setAuthor(\MRS\ModelBundle\Entity\Author $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \MRS\ModelBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
