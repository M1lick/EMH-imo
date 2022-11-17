<?php 
namespace App\Entity; 
use Symfony\Component\Validator\Constraints as Assert;

class Contact{
    /**
     * @var String|null 
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=100)
     */
    private $firstname;
        /**
     * @var String|null 
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=100)
     */
    private $lastname;
        /**
     * @var String|null 
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern="/[0-9]{10}/"
     * )
     */
    private $phone;
            /**
     * @var String|null 
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
        /**
     * @var String|null 
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;
    /**
     * @var Property|null
     */
    private $property;

	/**
	 * 
	 * @return String|null
	 */
	public function getMessage() {
		return $this->message;
	}
	
	/**
	 * 
	 * @param String|null $message 
	 * @return self
	 */
	public function setMessage($message): self {
		$this->message = $message;
		return $this;
	}

	/**
	 * 
	 * @return String|null
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * 
	 * @param String|null $email 
	 * @return self
	 */
	public function setEmail($email): self {
		$this->email = $email;
		return $this;
	}

	/**
	 * 
	 * @return String|null
	 */
	public function getPhone() {
		return $this->phone;
	}
	
	/**
	 * 
	 * @param String|null $phone 
	 * @return self
	 */
	public function setPhone($phone): self {
		$this->phone = $phone;
		return $this;
	}

	/**
	 * 
	 * @return String|null
	 */
	public function getLastname() {
		return $this->lastname;
	}
	
	/**
	 * 
	 * @param String|null $lastname 
	 * @return self
	 */
	public function setLastname($lastname): self {
		$this->lastname = $lastname;
		return $this;
	}

	/**
	 * 
	 * @return String|null
	 */
	public function getFirstname() {
		return $this->firstname;
	}
	
	/**
	 * 
	 * @param String|null $firstname 
	 * @return self
	 */
	public function setFirstname($firstname): self {
		$this->firstname = $firstname;
		return $this;
	}

	/**
	 * 
	 * @return Property|null
	 */
	public function getProperty() {
		return $this->property;
	}
	
	/**
	 * 
	 * @param Property|null $property 
	 * @return self
	 */
	public function setProperty($property): self {
		$this->property = $property;
		return $this;
	}
}