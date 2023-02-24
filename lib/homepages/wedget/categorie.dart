import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import '../model/categorie_model.dart';

class CategorieItem extends StatelessWidget {
  final Categorie categorie;
  const CategorieItem({Key? key, required this.categorie}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Stack(
      alignment: Alignment.center,
      children: [
        Image.asset(categorie.image,width: double.maxFinite,fit: BoxFit.fill,),
        // Positioned(
        //   left: 45,
        //   child: Text(categorie.title,style: TextStyle(color: Colors.white,fontWeight: FontWeight.w700,fontSize: 17),),
        // ),

      ],
    );
  }
}
