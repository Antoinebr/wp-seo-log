# wp-seo-log
Plugin WordPress permettant de monitorer le passage de GoogeBot

Ce plugin est en plein développement, il n'est pas recommander de l'utiliser en l'état.

## strucutre de la table MYSQL 


```sql

-- Structure de la table `wp_wpseolog`
--
CREATE TABLE `wp_wpseolog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(455) NOT NULL,
  `date` datetime NOT NULL,
  `rescode` int(3) NOT NULL,
  `nbcrawl` int(11) NOT NULL,
  `seovisited` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

```


