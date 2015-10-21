<?php
class DateHandler
{
    const DB_DATE = 'Y-m-d';
    const VW_DATE = 'm/d/Y';
    const DB_DATETIME = 'Y-m-d H:i:s';
    const VW_DATETIME = 'm/d/Y H:i';
    
    public static function date($date = null)
	{
		if (!$date)
            return date(self::DB_DATE);
        
        return date(self::DB_DATE, strtotime($date));
	}

	public static function dateView($date = null)
	{
		if (!$date)
            return date(self::VW_DATE);
        
        return date(self::VW_DATE, strtotime($date));
	}
    
    public static function dateTime($dateTime = null)
	{
		if (!$dateTime)
            return self::now();
        
        return date(self::DB_DATETIME, strtotime($dateTime));
	}

	public static function dateTimeView($dateTime = null)
	{
		if (!$dateTime)
            return self::nowView();
        
        return date(self::VW_DATETIME, strtotime($dateTime));
	}
    
	public static function now()
	{
		return date(self::DB_DATETIME);
	}
    
	public static function nowView()
	{
		return date(self::VW_DATETIME);
	}
}