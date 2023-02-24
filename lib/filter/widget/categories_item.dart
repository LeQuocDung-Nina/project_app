
import 'package:demo1/homepages/model/categorie_model.dart';
import 'package:flutter/material.dart';

import '../../constants.dart';

class CategorieRatingItem extends StatelessWidget {
  const CategorieRatingItem({Key? key, required this.categorie}) : super(key: key);
  final Categorie categorie;

  @override
  Widget build(BuildContext context) {
    // return Column(
    //   children: [
    //     Padding(padding: const EdgeInsets.only(bottom: 20),
    //     child: Align(child: Text(categorie.title), alignment: Alignment.centerLeft,),),
    //     const Divider(height: 1,color: linegreyColor, thickness: 0.5),
    //   ],
    // );
    return Container(
      padding: const EdgeInsets.only(bottom: 20),
      decoration: const BoxDecoration(
        border: Border(
          bottom: BorderSide(
            color: linegreyColor,
            width: 1,
            style: BorderStyle.solid
          ),
        ),
      ),
      child: Text(categorie.title,style: TextStyle(color: greytitle,fontSize: 16,fontWeight: FontWeight.w400),),

    );
  }
}
