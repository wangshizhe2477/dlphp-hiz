<?php
return array(
    // FLEA_Exception_ExpectedFile
    0x0102001 => 'Required file "%s" is missing.',
    // FLEA_Exception_ExpectedClass
    0x0102002 => 'Required class "%s" can not be found in file "%s."',
    0x0102003 => 'Required class "$s" is not defined.',
    // FLEA_Exception_ExistsKeyName
    0x0102004 => 'Key "%s" already exists.',
    // FLEA_Exception_InvalidArguments
    0x0102006 => 'Invalid parameter "%s".',
    // FLEA_Exception_NotExistsKeyName
    0x0102009 => 'Required key "%s" does not exist.',
    // FLEA_Exception_NotImplemented
    0x010200a => 'Class method "$s::$s" is empty.',
    0x010200b => 'Function "%s" is empty.',
    // FLEA_Exception_TypeMismatch
    0x010200c => 'The data type of parameter "%s" is "%s", but expected to be "%s".',
    // FLEA_Exception_CacheDisabled
    0x010200d => 'Cache function is disabled now. This is usually because internalCacheDir option is not defined or internalCacheDir directory is unwritable',

    // FLEA_Exception_MissingAction
    0x0103001 => 'Controller method "%s::%s()" is missing.',
    // FLEA_Exception_MissingController
    0x0103002 => 'Controller "%s" is missing.',

    // FLEA_Exception_ValidationFailed
    0x0407001 => 'The following data is invalid: "%s".',

    // FLEA_Db_Exception_InvalidDSN
    0x06ff001 => 'Invalid DSN(Data-Source-Name).',
    // FLEA_Db_Exception_MissingDSN
    0x06ff002 => 'dbDSN has to be set a value.',
    // FLEA_Db_Exception_MissingPrimaryKey
    0x06ff003 => 'The value of primary key "%s" is missing.',
    // FLEA_Db_Exception_PrimaryKeyExists
    0x06ff004 => 'Primary key "%s" = "%s" already exists.',
    // FLEA_Db_Exception_SqlQuery
    0x06ff005 => "SQL Error Message: \"%s\"\nSQL : \"%s\"\nSQL Error code: \"%s\".",
    0x06ff006 => "SQL Script: \"%s\"\nSQL Error Code: \"%s\".",
    // FLEA_Db_Exception_MetaColumnsFailed
    0x06ff007 => "Failed to get meta data from table \"%s\".",
    // FLEA_Db_Exception_InvalidInsertID
    0x06ff008 => "Can not get the ID generated for an AUTO_INCREMENT column by previous INSERT query.",
    // FLEA_Db_Exception_MissingLink
    0x06ff009 => "Association object \"%s\" does not exist.",

    // FLEA_Db_Exception_InvalidLinkType
    0x0202001 => 'Invalid table association type "%s".',
    // FLEA_Db_Exception_MissingLinkOption
    0x0202002 => 'Option "%s" is required when creating table association.',
);
