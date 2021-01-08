CREATE TABLE `bulletin_board` (
  `id` char(32) NOT NULL DEFAULT '' COMMENT 'ID',
  `delete_at` int(10) NOT NULL COMMENT '删除时间',
  `create_at` int(10) NOT NULL COMMENT '创建时间',
  `update_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` text NOT NULL COMMENT '封面',
  `content` text NOT NULL COMMENT '内容',
  `class_id` char(32) NOT NULL COMMENT '分类ID',
  `file` text NOT NULL COMMENT '附件',
  `admin_id` char(32) NOT NULL COMMENT '管理员ID',
  `user_id` char(32) NOT NULL DEFAULT '' COMMENT '用户ID',
  `user_list` text NOT NULL COMMENT '用户可见范围（全部可见时为空）',
  `dept_list` text NOT NULL COMMENT '部门可见范围（全部可见时为空',
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `bulletin_board_class` (
  `id` char(32) NOT NULL DEFAULT '' COMMENT 'ID',
  `delete_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `create_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `admin_id` char(32) NOT NULL DEFAULT '' COMMENT '管理员ID',
  `user_list` text NOT NULL COMMENT '用户列表',
  `dept_list` text NOT NULL COMMENT '部门列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;