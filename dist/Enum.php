<?php
/**
 * Enum type
 *
 * @author hwoltersdorf
 */

namespace hollodotme\Types;

/**
 * Class Enum
 *
 * @package hollodotme\Types
 */
abstract class Enum
{

	/** @var mixed */
	private $value;

	/**
	 * @param null|mixed $value
	 *
	 * @throws \InvalidArgumentException
	 */
	final public function __construct( $value = null )
	{
		$value = $this->getDefaultValueIfNeccessary( $value );

		$this->guardValidValue( $value );

		$this->value = $value;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return mixed
	 */
	private function getDefaultValueIfNeccessary( $value )
	{
		if ( is_null( $value ) )
		{
			$value = $this->getDefaultValue();
		}

		return $value;
	}

	/**
	 * @param mixed $value
	 *
	 * @throws \InvalidArgumentException
	 */
	private function guardValidValue( $value )
	{
		$this->guardValueIsScalar( $value );
		$this->guardValueIsInConstants( $value );
	}

	/**
	 * @param mixed $value
	 *
	 * @throws \InvalidArgumentException
	 */
	private function guardValueIsScalar( $value )
	{
		if ( !is_scalar( $value ) && !is_null( $value ) )
		{
			throw new \InvalidArgumentException( 'Value is not scalar or null: ' . gettype( $value ) );
		}
	}

	/**
	 * @param mixed $value
	 *
	 * @throws \InvalidArgumentException
	 */
	private function guardValueIsInConstants( $value )
	{
		if ( !in_array( $value, $this->getValues(), true ) )
		{
			throw new \InvalidArgumentException(
				$value . ' is not defined as class constant of enum ' . get_class( $this )
			);
		}
	}

	/**
	 * @return mixed
	 */
	abstract public function getDefaultValue();

	/**
	 * @return array
	 */
	final public function getValues()
	{
		$ref_class = new \ReflectionClass( $this );
		$ref_constants = $ref_class->getConstants();

		return array_values( $ref_constants );
	}

	/**
	 * @return string
	 */
	final public function __toString()
	{
		return strval( $this->value );
	}

	/**
	 * @param mixed $other_value
	 *
	 * @return bool
	 */
	final public function equals( $other_value )
	{
		return ($this->value === $other_value);
	}
}
