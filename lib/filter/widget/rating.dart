import 'package:flutter/material.dart';

import '../../constants.dart';


class RatingProduct extends StatefulWidget {
  const RatingProduct({Key? key}) : super(key: key);

  @override
  State<RatingProduct> createState() => _RatingProductState();
}

class _RatingProductState extends State<RatingProduct> {

  double _lowValue = 0.0;
  double _heighValue = 0.0;

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Row(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children:  [
            Text("Khoảng giá",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 17,color: bLtitleColor),),
            Row(
              children: [
                Text(_lowValue.toString(),style: TextStyle(fontWeight: FontWeight.w700,fontSize: 15,color: bLtitleColor),),
                Text(" ~ ",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 15,color: bLtitleColor),),
                Text(_heighValue.toString(),style: TextStyle(fontWeight: FontWeight.w700,fontSize: 15,color: bLtitleColor),),
              ],
            ),

          ],
        ),
        Padding(
          padding: const EdgeInsets.symmetric(vertical: 20),
          child: RangeSlider(
            values: RangeValues(_lowValue,_heighValue),
            min: 0,
            max: 2000,
            divisions: 10,
            activeColor: priceColor,
            inactiveColor: greyreview,
            labels: RangeLabels(
              _lowValue.round().toString(),
              _heighValue.round().toString(),
            ),
            onChanged: (_range) {
              setState(() {
                _lowValue = _range.start;
                _heighValue = _range.end;
              });
            },
          ),
        ),
      ],
    );
  }
}
