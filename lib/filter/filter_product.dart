import 'Categorie.dart';
import 'widget/rating.dart';
import 'package:flutter/material.dart';
import '../constants.dart';
import 'widget/star_rating.dart';


class FilterProduct extends StatelessWidget {
  const FilterProduct({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text("Lọc sản phẩm",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 19,color: bLtitleColor),),
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: EdgeInsets.symmetric(vertical: 0,horizontal: 20),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: const [
              RatingProduct(),
              StarRating(),
              CategorieRating(),
            ],
          ),
        ),
      ),
      bottomNavigationBar: Container(padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 20),height: 90,
        child: Row(
          children: [
            Expanded(
              child: ElevatedButton(
                onPressed: () {  },
                style: ElevatedButton.styleFrom(
                  primary: bgbutton,
                  onPrimary: priceColor,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12), // <-- Radius
                  ),
                ),
                child: const Center(child: Text("Xóa",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 16,color: priceColor),),),
              ),
            ),
            const SizedBox(width: 30,),
            Expanded(
              child: ElevatedButton(
                onPressed: () {  },
                style: ElevatedButton.styleFrom(
                  primary: priceColor,
                  onPrimary: bgbutton,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12), // <-- Radius
                  ),
                ),
                child: const Center(child: Text("Lọc",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 16,color: Colors.white),),),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

