/*
Navicat MySQL Data Transfer

Source Server         : MySql
Source Server Version : 50153
Source Host           : localhost:3306
Source Database       : invetario_developer

Target Server Type    : MYSQL
Target Server Version : 50153
File Encoding         : 65001

Date: 2017-07-20 16:52:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bodega`
-- ----------------------------
DROP TABLE IF EXISTS `bodega`;
CREATE TABLE `bodega` (
  `id_bod` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_bod` varchar(20) DEFAULT NULL,
  `direccion_bod` text,
  `estado_bod` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_bod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bodega
-- ----------------------------

-- ----------------------------
-- Table structure for `cliente`
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_cli` int(11) NOT NULL AUTO_INCREMENT,
  `direccion_tra_cli` text,
  `telefono_tra_cli` varchar(10) DEFAULT NULL,
  `id_per` int(11) NOT NULL,
  PRIMARY KEY (`id_cli`),
  KEY `id_per` (`id_per`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `persona` (`id_per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cliente
-- ----------------------------

-- ----------------------------
-- Table structure for `empleado`
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado` (
  `id_empl` int(11) NOT NULL AUTO_INCREMENT,
  `direccion_empl` text,
  `telefono_empl` varchar(10) DEFAULT NULL,
  `id_per` int(11) NOT NULL,
  PRIMARY KEY (`id_empl`),
  KEY `id_per` (`id_per`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `persona` (`id_per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of empleado
-- ----------------------------

-- ----------------------------
-- Table structure for `kardex`
-- ----------------------------
DROP TABLE IF EXISTS `kardex`;
CREATE TABLE `kardex` (
  `id_kar` int(11) NOT NULL AUTO_INCREMENT,
  `cant_entrada_kar` int(11) DEFAULT NULL,
  `cant_salida_kar` int(11) DEFAULT NULL,
  `fecha_kar` date DEFAULT NULL,
  `descripcion_cant_kar` text,
  `id_pd` int(11) NOT NULL,
  PRIMARY KEY (`id_kar`),
  KEY `id_pd` (`id_pd`),
  CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`id_pd`) REFERENCES `producto_bodega` (`id_pd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kardex
-- ----------------------------

-- ----------------------------
-- Table structure for `marca`
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `id_mar` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_mar` varchar(20) DEFAULT NULL,
  `estado_mar` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_mar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of marca
-- ----------------------------

-- ----------------------------
-- Table structure for `marca_producto_proveedor`
-- ----------------------------
DROP TABLE IF EXISTS `marca_producto_proveedor`;
CREATE TABLE `marca_producto_proveedor` (
  `id_mpp` int(11) NOT NULL AUTO_INCREMENT,
  `id_mar` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  PRIMARY KEY (`id_mpp`),
  KEY `id_pro` (`id_pro`),
  KEY `id_prod` (`id_prod`),
  KEY `id_mar` (`id_mar`),
  CONSTRAINT `marca_producto_proveedor_ibfk_1` FOREIGN KEY (`id_pro`) REFERENCES `proveedor` (`id_pro`),
  CONSTRAINT `marca_producto_proveedor_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id_prod`),
  CONSTRAINT `marca_producto_proveedor_ibfk_3` FOREIGN KEY (`id_mar`) REFERENCES `marca` (`id_mar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of marca_producto_proveedor
-- ----------------------------

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nodo_menu` int(11) DEFAULT NULL,
  `nodo_hijo_menu` int(11) DEFAULT NULL,
  `descripcion_menu` varchar(20) DEFAULT NULL,
  `url_menu` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', null, null, 'MODULO USUARIO', null);
INSERT INTO `menu` VALUES ('2', null, null, 'MODULO PROVEEDORES', null);
INSERT INTO `menu` VALUES ('3', null, null, 'MODULO KARDEX', null);
INSERT INTO `menu` VALUES ('4', null, null, 'MODULO PRODUCTO', null);
INSERT INTO `menu` VALUES ('5', null, null, 'MODULO REPORTES', null);
INSERT INTO `menu` VALUES ('6', null, null, 'MODULO EMPLEADO', null);

-- ----------------------------
-- Table structure for `permisos`
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id_perm` int(11) NOT NULL AUTO_INCREMENT,
  `permiso_perm` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_perm`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES ('1', 'LEER');
INSERT INTO `permisos` VALUES ('2', 'GUARDAR');
INSERT INTO `permisos` VALUES ('3', 'MODIFICAR');
INSERT INTO `permisos` VALUES ('4', 'ELIMINAR');
INSERT INTO `permisos` VALUES ('5', 'IMPRIMIR');

-- ----------------------------
-- Table structure for `persona`
-- ----------------------------
DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `id_per` int(11) NOT NULL AUTO_INCREMENT,
  `dni_per` varchar(20) DEFAULT NULL,
  `nombre_per` varchar(20) DEFAULT NULL,
  `apellido_per` varchar(20) DEFAULT NULL,
  `genero_per` varchar(1) DEFAULT NULL,
  `direccion_per` text,
  `telefono_per` varchar(10) DEFAULT NULL,
  `celular_per` varchar(10) DEFAULT NULL,
  `correo_per` text,
  `estado_per` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_per`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of persona
-- ----------------------------
INSERT INTO `persona` VALUES ('1', '1722222222', 'CRISTHIAN JAVIER', 'BALLESTEROS REYES', 'M', 'CARAPUNGO', '0222222222', '0900000003', 'llamahair04@gmail.com', '1');

-- ----------------------------
-- Table structure for `producto`
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prod` varchar(40) DEFAULT NULL,
  `categoria_prod` varchar(40) DEFAULT NULL,
  `precio_prod` decimal(11,4) DEFAULT NULL,
  `codigo_prod` varchar(20) DEFAULT NULL,
  `estado_prod` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of producto
-- ----------------------------

-- ----------------------------
-- Table structure for `producto_bodega`
-- ----------------------------
DROP TABLE IF EXISTS `producto_bodega`;
CREATE TABLE `producto_bodega` (
  `id_pd` int(11) NOT NULL AUTO_INCREMENT,
  `id_mpp` int(11) NOT NULL,
  `id_bod` int(11) NOT NULL,
  PRIMARY KEY (`id_pd`),
  KEY `id_bod` (`id_bod`),
  KEY `id_mpp` (`id_mpp`),
  CONSTRAINT `producto_bodega_ibfk_1` FOREIGN KEY (`id_bod`) REFERENCES `bodega` (`id_bod`),
  CONSTRAINT `producto_bodega_ibfk_2` FOREIGN KEY (`id_mpp`) REFERENCES `marca_producto_proveedor` (`id_mpp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of producto_bodega
-- ----------------------------

-- ----------------------------
-- Table structure for `proveedor`
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor` (
  `id_pro` int(11) NOT NULL AUTO_INCREMENT,
  `direccion_emp_pro` text,
  `telefono_emp_pro` varchar(10) DEFAULT NULL,
  `id_per` int(11) NOT NULL,
  PRIMARY KEY (`id_pro`),
  KEY `id_per` (`id_per`),
  CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `persona` (`id_per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proveedor
-- ----------------------------

-- ----------------------------
-- Table structure for `rol`
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_rol` varchar(20) DEFAULT NULL,
  `permiso_modulo` text,
  `estado_rol` varchar(1) DEFAULT NULL,
  `id_usu` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`),
  KEY `id_usu` (`id_usu`),
  CONSTRAINT `rol_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id_usu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES ('1', 'PEPITO', '[{\"Id_menu\": 1, \"Descipcion\": \"MODULO USUARIO\", \"access_save\": 0, \"access_edit\": 0, \"access_delete\": 0, \"access_print\": 0 }, {\"Id_menu\": 2, \"Descipcion\": \"MODULO PROVEEDORES\", \"access_save\": 1, \"access_edit\": 1, \"access_delete\": 1, \"access_print\": 1 }, {\"Id_menu\": 3, \"Descipcion\": \"MODULO KARDEX\", \"access_save\": 0, \"access_edit\": 0, \"access_delete\": 0, \"access_print\": 0 } ]', '1', '1');

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_usu` varchar(20) DEFAULT NULL,
  `password_usu` varchar(200) DEFAULT NULL,
  `id_per` int(11) NOT NULL,
  PRIMARY KEY (`id_usu`),
  KEY `id_per` (`id_per`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `persona` (`id_per`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'MIJIN', '202cb962ac59075b964b07152d234b70', '1');
