-- 
-- Table `tl_alert_archive`
-- 

CREATE TABLE `tl_alert_archive` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `year` varchar(4) NOT NULL default '',
  `galleryPage` int(10) unsigned NOT NULL default '0',
  `published` char(1) NOT NULL default '',
  `start` varchar(10) NOT NULL default '',
  `stop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 
-- Table `tl_alert`
-- 

CREATE TABLE `tl_alert` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `type` varchar(255) NOT NULL default '',
  `alias` varbinary(128) NOT NULL default '',
  `alertNumber` int(10) NOT NULL,
  `dateStart` varchar(10) NOT NULL default '',
  `dateEnd` varchar(10) NOT NULL default '',
  `location` varchar(255) NOT NULL default '',
  `latlng` varchar(255) NOT NULL default '',
  `description` text NULL,
  `imagelink` char(1) NOT NULL default '',
  `previewTitle` varchar(255) NOT NULL default '',
  `alt` varchar(255) NOT NULL default '',
  `previewCaption` varchar(55) NOT NULL default '',
  `preview` varchar(255) NOT NULL default '',
  `previewSize` varchar(64) NOT NULL default '',
  `images` blob NULL,
  `published` char(1) NOT NULL default '',
  `start` varchar(10) NOT NULL default '',
  `stop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table `tl_module`
--

CREATE TABLE `tl_module` (
  `fwm_alert_archives` int(10) unsigned NOT NULL default '0',
  `fwm_alert_menulinks` blob NULL,
  `fwm_alert_archive_reader` int(10) unsigned NOT NULL default '0',
  `fwm_alert_gallery_thumbs` varchar(64) NOT NULL default '',
  `fwm_all_link` char(1) NOT NULL default '',
  `fwm_chartShowTitle` char(1) NOT NULL default '',
  `fwm_chartPositionLegend` varchar(64) NOT NULL default '',
  `fwm_chartWidth` varchar(64) NOT NULL default '',
  `fwm_chartBg` varchar(64) NOT NULL default '',
  `fwm_chartColors` varchar(255) NOT NULL default '',
  `fwm_template` varchar(32) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table `tl_content`
--

CREATE TABLE `tl_content` (
  `fwm_statisticType` varchar(255) NOT NULL default '',
  `fwm_statisticYear` varchar(64) NOT NULL default '',
  `fwm_chartShowTitle` char(1) NOT NULL default '',
  `fwm_chartPositionLegend` varchar(64) NOT NULL default '',
  `fwm_chartWidth` varchar(64) NOT NULL default '',
  `fwm_chartBg` varchar(64) NOT NULL default '',
  `fwm_chartColors` varchar(255) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
