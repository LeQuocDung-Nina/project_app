import 'package:flutter/material.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import '../constants.dart';
import '../pay/model/product_order_item_model.dart';
import '../pay/wedget/product_order_item.dart';

class Body extends StatelessWidget {
  const Body({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            const SizedBox(height: 10,),
            Categories(),
            TextNotifi(),
            DateOrder(),
            ScrollViewOrder(),
        ]
      ),
    );
  }
}

class TextNotifi extends StatefulWidget {
  @override
  State<TextNotifi> createState() => _TextNotifiState();
}

class _TextNotifiState extends State<TextNotifi> {
  @override
  Widget build(BuildContext context) {
    return Row(
        // crossAxisAlignment: CrossAxisAlignment.end,
        mainAxisAlignment: MainAxisAlignment.end,
        children: const <Widget> [
          Padding(
            padding: EdgeInsets.symmetric(vertical: 12.0),
            child: Text("Đang đợi lấy hàng",style: TextStyle(fontSize: 12,fontWeight: FontWeight.w400,),),
          )
        ],
    );
  }
}

//List view category
class Categories extends StatefulWidget {
  @override
  State<Categories> createState() => _CategoriesState();
}

class _CategoriesState extends State<Categories> {
  List<String> categories = ["Tất cả","Chờ xác nhận","Chờ lấy hàng","Đang giao","Đã giao"];
  int selectedIndex  = 0;
  @override
  Widget build(BuildContext context) {
    return SizedBox(
      height: 25,
      child: ListView.builder(
        scrollDirection: Axis.horizontal,
        itemCount: categories.length,
        itemBuilder: (context, index) => buildCategory(index),
      ),
    );
  }
  Widget buildCategory(int index) {
    return GestureDetector(
      onTap: () {
        setState(() {
          selectedIndex = index;
        });
      },
      child: Padding(
      padding: const EdgeInsets.symmetric(horizontal: 24.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Text(
              categories[index],
                style: TextStyle(
                fontWeight: FontWeight.w400,
                color: selectedIndex == index ? kTextColor : kTextLightColor,
                fontSize: 12,

              ),
            ),
            Container(
              margin: const EdgeInsets.only(top: 5.0),
              height: 2,
              width: 30,

              color: selectedIndex == index ? Colors.black : Colors.transparent,
            )
          ],
        ),
      ),
    );
  }
}

//Date order
class DateOrder extends StatefulWidget {
  @override
  State<DateOrder> createState() => _DateOrderState();
}

class _DateOrderState extends State<DateOrder> {
  @override
  Widget build(BuildContext context) {
    return Column(
        children: [
          Container(
            // height: 50,
              padding: const EdgeInsets.symmetric(vertical: 15.0,horizontal: 15.0),
              decoration: BoxDecoration(
              color: grayColor,
              borderRadius: BorderRadius.circular(10)
            ),
            child: Row(
                children: const <Widget> [
                   Expanded(child: Text("Ngày giao dự kiến",style: TextStyle(color: bLtitle2Color,fontSize: 12) ,textAlign: TextAlign.left,)),
                   Expanded(child: Text("Nov 18 - Oct 30",style: TextStyle(color: kTextColor,fontSize: 15,fontWeight: FontWeight.w700),textAlign: TextAlign.right,)),
                ],
            ),
          )
      ],
    );
  }
}

class ScrollViewOrder extends StatefulWidget {
  const ScrollViewOrder({Key? key}) : super(key: key);

  @override
  State<ScrollViewOrder> createState() => _ScrollViewOrderState();
}

class _ScrollViewOrderState extends State<ScrollViewOrder> {
  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: <Widget>[
        const SizedBox(height: 15,),
        AlignedGridView.count(
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          itemCount: products.length,
          crossAxisCount: 1,
          mainAxisSpacing: 20,
          crossAxisSpacing: 20,
          itemBuilder: (context, index) => ProductOrderItem(
              product_order_item: products[index]),
        ),
        Row(
          mainAxisAlignment: MainAxisAlignment.end,
          children: [
            RichText(text: const TextSpan(
                style: TextStyle(color: bLtitle2Color,fontSize: 14),
                children: [
                  TextSpan(text: "3 ",),
                  TextSpan(text: "Mặt hàng: ",),
                  TextSpan(text: "290.000",),
                  TextSpan(text: "đ",),
                ]
            )),
          ],
        ),
        SizedBox(height: 30,)
      ],
    );
  }
}






