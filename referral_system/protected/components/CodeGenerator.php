<?php
class CodeGenerator
{
    const PASSWORD_LENGTH = 8;
    const CODE_LENGTH = 16;
    
	public static function generate($length = 6)
	{
		if ($length >= 32)
            $length = 32;
		return substr(md5((string)rand()), 0, $length);
	}
    
	public static function generatePassword()
	{
		return self::generate(self::PASSWORD_LENGTH);
	}
    
	public static function generateCode()
	{
		return self::generate(self::CODE_LENGTH);
	}
}