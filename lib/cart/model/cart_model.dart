import 'package:flutter/material.dart';

 class Cart{
   final int id, pirce;
   final String image, title;

   Cart({ required this.id, required this.pirce, required this.image,required this.title});
}

List<Cart> carts = [
  Cart(id: 1, pirce: 750000, image: "assets/images/cart1.png", title: "Áo thun nữ thời trang 1"),
  Cart(id: 1, pirce: 750000, image: "assets/images/cart2.png", title: "Áo thun nữ thời trang 2"),
  Cart(id: 1, pirce: 750000, image: "assets/images/cart3.png", title: "Áo thun nữ thời trang 3"),
  Cart(id: 1, pirce: 750000, image: "assets/images/cart4.png", title: "Áo thun nữ thời trang 4"),
  Cart(id: 1, pirce: 750000, image: "assets/images/cart5.png", title: "Áo thun nữ thời trang 5"),
];