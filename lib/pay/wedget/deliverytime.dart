import 'package:flutter/material.dart';
import 'package:getwidget/getwidget.dart';

import '../../constants.dart';


class DeliveryTime extends StatefulWidget {
  const DeliveryTime({Key? key}) : super(key: key);

  @override
  State<DeliveryTime> createState() => _DeliveryTimeState();
}

class _DeliveryTimeState extends State<DeliveryTime> {

  int groupValue = 0;

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      mainAxisAlignment: MainAxisAlignment.start,
      children: [
        const Text("Thông tin nhận hàng",style: TextStyle(fontSize: 16,fontWeight: FontWeight.w700,color: kTextColor),),
        SizedBox(height: 20,),
        Row(
          children: [
            GFRadio(
              size: 20,
              value: 1,
              groupValue: groupValue,
              onChanged: (value) {
                setState(() {
                  groupValue = value;
                });
              },
              inactiveIcon: null,
              activeBorderColor: priceColor,
              radioColor: priceColor,
            ),
            SizedBox(width: 15,),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                mainAxisAlignment: MainAxisAlignment.start,
                children: const [
                  Text("Giao hàng giờ hành chính",style: TextStyle(fontSize: 16,color: kTextColor,fontWeight: FontWeight.w400),),
                  SizedBox(height: 10,),
                  Text("Phù hợp văn phòng / cơ quan",style: TextStyle(fontSize: 13,color: bLtitle2Color,fontWeight: FontWeight.w400),),
                ],
              ),
            ),
          ],
        ),
        SizedBox(height: 20,),
        Row(
          children: [
            GFRadio(
              size: 20,
              value: 2,
              groupValue: groupValue,
              onChanged: (value) {
                setState(() {
                  groupValue = value;
                });
              },
              inactiveIcon: null,
              activeBorderColor: priceColor,
              radioColor: priceColor,
            ),
            SizedBox(width: 15,),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                mainAxisAlignment: MainAxisAlignment.start,
                children: const [
                  Text("Tất cả các ngày trong tuần",style: TextStyle(fontSize: 16,color: kTextColor,fontWeight: FontWeight.w400),),
                  SizedBox(height: 10,),
                  Text("Phù hợp với nhà riêng",style: TextStyle(fontSize: 13,color: bLtitle2Color,fontWeight: FontWeight.w400),),
                ],
              ),
            ),
          ],
        ),
        SizedBox(height: 20,),
        Row(
          children: [
            GFRadio(
              size: 20,
              value: 3,
              groupValue: groupValue,
              onChanged: (value) {
                setState(() {
                  groupValue = value;
                });
              },
              inactiveIcon: null,
              activeBorderColor: priceColor,
              radioColor: priceColor,
            ),
            SizedBox(width: 15,),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                mainAxisAlignment: MainAxisAlignment.start,
                children: const [
                  Text("Giao hàng trong 2h",style: TextStyle(fontSize: 16,color: kTextColor,fontWeight: FontWeight.w400),),
                  SizedBox(height: 10,),
                  Text("Áp dụng địa chỉ giao hàng tại Tp. Hồ Chí Minh",style: TextStyle(fontSize: 13,color: bLtitle2Color,fontWeight: FontWeight.w400),),
                ],
              ),
            ),
          ],
        ),
      ],
    );
  }
}


