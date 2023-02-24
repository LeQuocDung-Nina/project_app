import 'package:carousel_slider/carousel_controller.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/material.dart';

class SlideShow extends StatefulWidget {
  const SlideShow({Key? key}) : super(key: key);

  @override
  State<SlideShow> createState() => _SlideShowState();
}

class _SlideShowState extends State<SlideShow> {

   List imageList = [
    {"id":1, "image_path":'assets/images/slideshow2.png'},
    {"id":2, "image_path":'assets/images/slideshow2.png'},
    {"id":3, "image_path":'assets/images/slideshow2.png'},
    {"id":4, "image_path":'assets/images/slideshow2.png'},
  ];
  final CarouselController carouselController = CarouselController();
  int currentIndex = 0;

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Stack(
        children: [
          InkWell(
            onTap: (){
              print(currentIndex);
            },
            child: CarouselSlider(
              items: imageList
                  .map(
                    (item) => Image.asset(
                  item['image_path'],
                  fit: BoxFit.contain,
                  width: double.infinity,
                ),
              )
                  .toList(),
              carouselController: carouselController,
              options: CarouselOptions(
                scrollPhysics: const BouncingScrollPhysics(),
                autoPlay: true,
                aspectRatio: 2,
                viewportFraction: 1,
                onPageChanged: (index, reason) {
                  setState(() {
                    currentIndex = index;
                  });
                },
              ),
            ),
          )
        ],
      ),
    );
  }
}
