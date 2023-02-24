import 'package:flutter/material.dart';
import 'package:getwidget/getwidget.dart';

import '../../constants.dart';




class StarRating extends StatefulWidget {
  const StarRating({Key? key}) : super(key: key);

  @override
  State<StarRating> createState() => _StarRatingState();
}

class _StarRatingState extends State<StarRating> {

  double _rating = 4;

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text("Đánh giá",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 17,color: bLtitleColor),),
        SizedBox(height: 20,),
        GFRating(
          color: Colors.amber,
          borderColor: Colors.amber,
          value: _rating,
          onChanged: (value) {
            setState(() {
              _rating = value;
              });
            },
          ),
        SizedBox(height: 20,),
      ],
    );
  }
}
