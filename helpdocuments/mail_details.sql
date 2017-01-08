--
-- Table structure for table `mail_details`
--

DROP TABLE IF EXISTS `mail_details`;
CREATE TABLE `mail_details` (
  `mail_detail_id` int(11) NOT NULL,
  `mail_detail_uid` int(11) NOT NULL,
  `mail_detail_sender` varchar(100) NOT NULL,
  `mail_detail_subject` varchar(150) NOT NULL,
  `mail_detail_message` text NOT NULL,
  `mail_detail_time_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mail_detail_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `mail_detail_archive` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mail_details`
--
ALTER TABLE `mail_details`
  ADD PRIMARY KEY (`mail_detail_id`),
  ADD KEY `mail_detail_uid` (`mail_detail_uid`),
  ADD KEY `mail_detal_archive` (`mail_detail_archive`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mail_details`
--
ALTER TABLE `mail_details`
  MODIFY `mail_detail_id` int(11) NOT NULL AUTO_INCREMENT;
