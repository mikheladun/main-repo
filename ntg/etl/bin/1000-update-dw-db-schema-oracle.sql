-- **************************************************************************
-- $Id: init-db-schema-oracle.sql 9795 2012-05-04 18:59:20Z ets\darylh $
--
-- The following code is the property of ERTH Business Technologies Inc.
-- Any attempt to redistribute the contents of this file, in whole or in part,
-- is strictly prohibited.
--
-- Copyright (c) 2012 ERTH Business Technologies Inc. All Rights Reserved.
--
-- http://www.ebterthcorp.com/
-- **************************************************************************
--  Description: adjust the static data common to all schema tables for the toronto build.
--
-- **************************************************************************

ALTER TABLE st_pre_readings ADD (mtu_id VARCHAR(50), port NUMBER(4), source CHAR(20));
ALTER SEQUENCE st_pre_readings_seq CACHE 1000;
