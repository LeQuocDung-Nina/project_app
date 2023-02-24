import 'package:demo1/filter/widget/categories_item.dart';
import 'package:demo1/homepages/model/categorie_model.dart';
import 'package:flutter/material.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';

import '../../constants.dart';

class CategorieRating extends StatelessWidget {

  const CategorieRating ({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text("Categories",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 17,color: bLtitleColor),),
        SizedBox(height: 30,),
        AlignedGridView.count(
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          itemCount: categories.length,
          crossAxisCount: 1,
          mainAxisSpacing: 20,
          crossAxisSpacing: 20,
          itemBuilder: (context, index) => CategorieRatingItem(
              categorie: categories[index]),
        ),
      ],
    );
  }
}


