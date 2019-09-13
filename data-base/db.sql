/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : db

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 13/09/2019 18:17:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for adminusers
-- ----------------------------
DROP TABLE IF EXISTS `adminusers`;
CREATE TABLE `adminusers`  (
  `userAdminID` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adminEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adminPassword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adminPhone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`userAdminID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci;

-- ----------------------------
-- Records of adminusers
-- ----------------------------
BEGIN;
INSERT INTO `adminusers` VALUES (1, 'User Admin', 'useradmin@hotmail.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '(11)99999-9999');
COMMIT;

-- ----------------------------
-- Table structure for carrinho
-- ----------------------------
DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE `carrinho`  (
  `cartID` int(11) NOT NULL,
  `produtoID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tamanho` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quantidade` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of carrinho
-- ----------------------------
BEGIN;
INSERT INTO `carrinho` VALUES (24, '1', 'G', '2'), (24, '2', 'P', '10'), (24, '25', NULL, '10');
COMMIT;

-- ----------------------------
-- Table structure for enderecos
-- ----------------------------
DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE `enderecos`  (
  `endereçoID` int(11) NOT NULL,
  `cep` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rua` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `número` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `complemento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bairro` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cidade` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`endereçoID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci;

-- ----------------------------
-- Records of enderecos
-- ----------------------------
BEGIN;
INSERT INTO `enderecos` VALUES (24, '58400312', 'Rua João Florentino de Carvalho\r\n', '483', '', 'Centro', 'Campina Grande', 'Paraíba');
COMMIT;

-- ----------------------------
-- Table structure for produtos
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos`  (
  `produtoID` int(11) NOT NULL AUTO_INCREMENT,
  `nomeProduto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `categoria` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `imagem1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `imagem2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `imagem3` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `detalhes` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modoDeUsar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tamanho1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tamanho2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tamanho3` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `preco` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`produtoID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of produtos
-- ----------------------------
BEGIN;
INSERT INTO `produtos` VALUES (1, 'táPET Standard', 'higiene', 'assets/images/produtos/jpg/tapet_standard.jpg', 'assets/images/produtos/jpg/tapet_standard2.jpg', 'assets/images/produtos/jpg/tapet_standard3.jpg', 'O táPET é um produto destinado a clientes que querem que seus cães querem fazendo suas necessidades em um lugar agradável, que deixa o chão limpo', NULL, 'P', 'M', 'G', 25.00), (2, 'táPET Tabloide', 'higiene', 'assets/images/produtos/jpg/taPET_tabloide.jpg', NULL, NULL, NULL, NULL, 'P', 'M', NULL, 17.50), (3, 'Jornal PET Standard', 'higiene', 'assets/images/produtos/jpg/jornal_Standard.jpg', NULL, NULL, '2kg', NULL, NULL, NULL, NULL, 10.00), (4, 'Jornal PET Tabloide', 'higiene', 'assets/images/produtos/jpg/jornal_tabloide.jpg', NULL, NULL, '1kg', NULL, NULL, NULL, NULL, 5.00), (5, 'Sleep PET', 'cama', 'assets/images/produtos/jpg/sleep_PET.jpg', NULL, NULL, 'Dimenções YxZ', NULL, NULL, NULL, NULL, 50.00), (6, 'RouPET', 'roupa', 'assets/images/produtos/jpg/1.jpg', NULL, NULL, 'Tamanho P', NULL, 'P', 'M', NULL, 30.00), (7, 'RouPET', 'roupa', 'assets/images/produtos/jpg/2.jpg', NULL, NULL, NULL, NULL, 'P', 'M', NULL, 30.00), (8, 'RouPET', 'roupa', 'assets/images/produtos/jpg/3.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (9, 'RouPET', 'roupa', 'assets/images/produtos/jpg/4.jpg', NULL, NULL, NULL, NULL, 'P', 'M', NULL, 30.00), (10, 'RouPET', 'roupa', 'assets/images/produtos/jpg/5.jpg', NULL, NULL, NULL, NULL, 'P', 'M', NULL, 30.00), (11, 'RouPET', 'roupa', 'assets/images/produtos/jpg/6.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (12, 'RouPET', 'roupa', 'assets/images/produtos/jpg/7.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (13, 'RouPET', 'roupa', 'assets/images/produtos/jpg/8.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (14, 'RouPET', 'roupa', 'assets/images/produtos/jpg/9.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (15, 'RouPET', 'roupa', 'assets/images/produtos/jpg/10.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (16, 'RouPET', 'roupa', 'assets/images/produtos/jpg/11.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (17, 'RouPET', 'roupa', 'assets/images/produtos/jpg/12.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (18, 'RouPET', 'roupa', 'assets/images/produtos/jpg/13.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (19, 'RouPET', 'roupa', 'assets/images/produtos/jpg/14.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (20, 'RouPET', 'roupa', 'assets/images/produtos/jpg/15.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (21, 'RouPET', 'roupa', 'assets/images/produtos/jpg/16.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (22, 'RouPET', 'roupa', 'assets/images/produtos/jpg/17.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (23, 'RouPET', 'roupa', 'assets/images/produtos/jpg/18.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (24, 'RouPET', 'roupa', 'assets/images/produtos/jpg/19.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (25, 'RouPET', 'roupa', 'assets/images/produtos/jpg/20.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (26, 'RouPET', 'roupa', 'assets/images/produtos/jpg/21.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (27, 'RouPET', 'roupa', 'assets/images/produtos/jpg/22.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00), (28, 'RouPET', 'roupa', 'assets/images/produtos/jpg/23.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.00);
COMMIT;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `usuarioID` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `primeiroNome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sobrenome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sexo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ddd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `celular` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dataNascimento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cpf` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cnpj` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`usuarioID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
BEGIN;
INSERT INTO `usuarios` VALUES (24, 'PF', 'User', 'lastname', 'Masculino', '11', '99999-9999', '15/12/2000', 'user@hotmail.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '270.831.880-25', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
