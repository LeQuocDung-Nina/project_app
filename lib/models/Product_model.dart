import 'package:flutter/material.dart';


class Product {
  final String image, title, description;
  final int price, size, id;
  final Color color;

  Product({
    required this.id,
    required this.image,
    required this.title,
    required this.price,
    required this.description,
    required this.size,
    required this.color,
  });
}

List<Product> products = [
  Product(
      id: 1,
      title: "Áo thun nữ thời trang",
      price: 350000,
      size: 12,
      description: dummyText,
      image: "assets/images/product2.png",
      color: Color(0xFF3D82AE)),
  Product(
      id: 2,
      title: "Belt Bag",
      price: 585000,
      size: 8,
      description: dummyText,
      image: "assets/images/product3.png",
      color: Color(0xFFD3A984)),
  Product(
      id: 3,
      title: "Áo thun nữ thời trang mới",
      price: 3500000,
      size: 10,
      description: dummyText,
      image: "assets/images/product4.png",
      color: Color(0xFF989493)),
  Product(
      id: 4,
      title: "Old Fashion",
      price: 650000,
      size: 11,
      description: dummyText,
      image: "assets/images/product5.png",
      color: Color(0xFFE6B398)),
  Product(
      id: 5,
      title: "Áo thun nữ thời trang",
      price: 750000,
      size: 12,
      description: dummyText,
      image: "assets/images/product2.png",
      color: Color(0xFFFB7883)),
  Product(
      id: 1,
      title: "Áo thun nữ thời trang",
      price: 350000,
      size: 12,
      description: dummyText,
      image: "assets/images/product2.png",
      color: Color(0xFF3D82AE)),
  Product(
      id: 2,
      title: "Belt Bag",
      price: 585000,
      size: 8,
      description: dummyText,
      image: "assets/images/product3.png",
      color: Color(0xFFD3A984)),
  Product(
      id: 3,
      title: "Áo thun nữ thời trang mới",
      price: 3500000,
      size: 10,
      description: dummyText,
      image: "assets/images/product4.png",
      color: Color(0xFF989493)),
  Product(
      id: 4,
      title: "Old Fashion",
      price: 650000,
      size: 11,
      description: dummyText,
      image: "assets/images/product5.png",
      color: Color(0xFFE6B398)),
  Product(
      id: 5,
      title: "Áo thun nữ thời trang",
      price: 750000,
      size: 12,
      description: dummyText,
      image: "assets/images/product2.png",
      color: Color(0xFFFB7883)),
  Product(
      id: 1,
      title: "Áo thun nữ thời trang",
      price: 350000,
      size: 12,
      description: dummyText,
      image: "assets/images/product2.png",
      color: Color(0xFF3D82AE)),
  Product(
      id: 2,
      title: "Belt Bag",
      price: 585000,
      size: 8,
      description: dummyText,
      image: "assets/images/product3.png",
      color: Color(0xFFD3A984)),
  Product(
      id: 3,
      title: "Áo thun nữ thời trang mới",
      price: 3500000,
      size: 10,
      description: dummyText,
      image: "assets/images/product4.png",
      color: Color(0xFF989493)),
  Product(
      id: 4,
      title: "Old Fashion",
      price: 650000,
      size: 11,
      description: dummyText,
      image: "assets/images/product5.png",
      color: Color(0xFFE6B398)),
  Product(
      id: 5,
      title: "Áo thun nữ thời trang",
      price: 750000,
      size: 12,
      description: dummyText,
      image: "assets/images/product2.png",
      color: Color(0xFFFB7883)),
  Product(
    id: 6,
    title: "Áo thun nữ thời trang ",
    price: 234000,
    size: 12,
    description: dummyText,
    image: "assets/images/product4.png",
    color: Color(0xFFAEAEAE),
  ),
];

String dummyText =
    "- Sản phẩm: SET ASHE W SKIRT "
    "- Màu sắc: Hồng nhạt, kem, đen, xám , đỏ "
    "- Màu sắc: Hồng nhạt, kem, đen, xám , đỏ "
    "- Màu sắc: Hồng nhạt, kem, đen, xám , đỏ "
    "- Màu sắc: Hồng nhạt, kem, đen, xám , đỏ "
    "- Chất vải: Cotton hàn";
