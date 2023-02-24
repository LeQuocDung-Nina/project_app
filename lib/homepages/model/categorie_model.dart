import 'package:flutter/material.dart';

class Categorie{
  final String image, title;
  final int id;

  Categorie({required this.image, required this.title, required this.id});
}

List <Categorie> categories = [
  Categorie(image: "assets/images/categorie1.png", title: "Hàng mới về", id: 1),
  Categorie(image: "assets/images/categorie2.png", title: "Hàng bán chạy", id: 2),
  Categorie(image: "assets/images/categorie3.png", title: "Áo khoác", id: 3),
  Categorie(image: "assets/images/categorie4.png", title: "Jumpsuit", id: 4),
];

